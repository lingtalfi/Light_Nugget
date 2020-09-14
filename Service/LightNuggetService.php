<?php


namespace Ling\Light_Nugget\Service;


use Ling\BabyYaml\BabyYamlUtil;
use Ling\Bat\FileSystemTool;
use Ling\Light\Helper\LightNamesAndPathHelper;
use Ling\Light\ServiceContainer\LightServiceContainerAwareInterface;
use Ling\Light\ServiceContainer\LightServiceContainerInterface;
use Ling\Light_MicroPermission\Service\LightMicroPermissionService;
use Ling\Light_Nugget\Exception\LightNuggetException;
use Ling\Light_Nugget\SecurityHandler\LightNuggetSecurityHandlerInterface;
use Ling\Light_UserManager\Service\LightUserManagerService;


/**
 * The LightNuggetService class.
 */
class LightNuggetService
{

    /**
     * This property holds the container for this instance.
     * @var LightServiceContainerInterface
     */
    protected $container;


    /**
     * Builds the LightNuggetService instance.
     */
    public function __construct()
    {
        $this->container = null;
    }

    /**
     * Sets the container.
     *
     * @param LightServiceContainerInterface $container
     */
    public function setContainer(LightServiceContainerInterface $container)
    {
        $this->container = $container;
    }



    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Returns the nugget identified by the given nuggetId and relPath.
     * See the @page(Light_Nugget conception notes) for more details.
     *
     * @param string $nuggetId
     * @param string $relPath
     * @return array
     * @throws \Exception
     */
    public function getNugget(string $nuggetId, string $relPath): array
    {
        $p = explode(':', $nuggetId, 2);
        if (2 !== count($p)) {
            $this->error("Invalid nuggetId format, \$plugin:\$suggestionPath was expected.");
        }
        list($plugin, $suggestionPath) = $p;

        $plugin = FileSystemTool::removeTraversalDots($plugin);
        $suggestionPath = FileSystemTool::removeTraversalDots($suggestionPath);


        $conf = null;
        $d = $this->container->getApplicationDir() . "/config/data/$plugin/$relPath";
        $f = $d . "/$suggestionPath.byml";
        if (false !== strpos($suggestionPath, 'generated')) {
            $custom = str_replace("generated", "custom", $suggestionPath);
            $f2 = $d . "/$custom.byml";
            if (true === file_exists($f2)) {
                $f = $f2;
            }
        }

        if (false === file_exists($f)) {
            $symbol = LightNamesAndPathHelper::getSymbolicPath($f, $this->container);
            $this->error("Nugget not found with nuggetId: $nuggetId ($symbol).");
        }

        return BabyYamlUtil::readFile($f);
    }


    /**
     * Check that the user is granted the permission to execute an action, and throws an exception if that's not the case.
     * This system is described in greater details in the @page(baked in security system section of the Light_Nugget conception notes).
     *
     * The params array is used if you define a custom handler.
     * Your custom handler defines what the params array should contain.
     *
     *
     * @param array $nugget
     * @param array $params
     */
    public function checkSecurity(array $nugget, array $params = [])
    {

        if (array_key_exists("security", $nugget)) {

            $security = $nugget["security"];


            //--------------------------------------------
            // ANY/ALL HANDLING
            //--------------------------------------------
            $any = $security['any'] ?? [];
            $all = $security['all'] ?? [];


            $um = null;
            $mp = null;


            /**
             * Note: the implementation below is not fixed (see conception notes),
             *  maybe we will be able to merge any and all in the future, but for now,
             * as I need to write something, I just execute them one after the other.
             */
            if ($any) {
                foreach ($any as $type => $value) {
                    switch ($type) {
                        case "permission":

                            if (null === $um) {
                                /**
                                 * @var $um LightUserManagerService
                                 */
                                $um = $this->container->get('user_manager');
                            }
                            $user = $um->getValidWebsiteUser();
                            if ($user->hasRight($value)) {
                                return; // the user is granted
                            }
                            break;
                        case "micro_permission":
                            if (null === $mp) {
                                /**
                                 * @var $mp LightMicroPermissionService
                                 */
                                $mp = $this->container->get("micro_permission");
                            }
                            if (true === $mp->hasMicroPermission($value)) {
                                return; // user is granted
                            }

                            break;
                        default:
                            $this->error("Unknown type: $type.");
                            break;
                    }
                }

            } elseif ($all) {
                foreach ($all as $type => $value) {
                    switch ($type) {
                        case "permission":

                            if (null === $um) {
                                /**
                                 * @var $um LightUserManagerService
                                 */
                                $um = $this->container->get('user_manager');
                            }
                            $user = $um->getValidWebsiteUser();
                            if (false === $user->hasRight($value)) {
                                $this->error("Permission denied: the current user is doesn't have the \"$value\" permission.");
                            }
                            break;
                        case "micro_permission":
                            if (null === $mp) {
                                /**
                                 * @var $mp LightMicroPermissionService
                                 */
                                $mp = $this->container->get("micro_permission");
                            }
                            if (false === $mp->hasMicroPermission($value)) {
                                $this->error("Permission denied: the current user is doesn't have the \"$value\" micro-permission.");
                            }

                            break;
                        default:
                            $this->error("Unknown type: $type.");
                            break;
                    }
                }
            }


            //--------------------------------------------
            // CUSTOM HANDLER
            //--------------------------------------------
            $handler = $security['handler'] ?? null;
            if (is_string($handler)) {
                $className = $handler;
                $handler = new $className();
                if ($handler instanceof LightServiceContainerAwareInterface) {
                    $handler->setContainer($this->container);
                }

                if (false === $handler instanceof LightNuggetSecurityHandlerInterface) {
                    $type = gettype($handler);
                    $this->error("The handler must be an instance of LightNuggetSecurityHandlerInterface, $type given.");
                }


                if (array_key_exists("handler_params", $security)) {
                    /**
                     * Let the developer params have precedence over the one defined in security.handler_params.
                     */
                    $params = array_merge($security['handler_params'], $params);
                }

                if (false === $handler->isGranted($params)) {
                    $this->error("Permission denied by custom handler ($className).");
                }
            }


        }
    }



    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Throws an exception.
     *
     * @param string $msg
     * @throws \Exception
     */
    private function error(string $msg)
    {
        throw new LightNuggetException($msg);
    }

}
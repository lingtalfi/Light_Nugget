<?php


namespace Ling\Light_Nugget\Service;


use Ling\BabyYaml\BabyYamlUtil;
use Ling\Bat\FileSystemTool;
use Ling\Light\Helper\LightNamesAndPathHelper;
use Ling\Light\ServiceContainer\LightServiceContainerInterface;
use Ling\Light_Nugget\Exception\LightNuggetException;


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
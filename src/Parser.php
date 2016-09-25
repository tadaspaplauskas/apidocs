<?php
namespace Paplauskas\ApiDocs;

class Parser
{
    protected $routesPath;

    public function __construct()
    {
        $this->routesPath = base_path('routes/api.php');
    }

    public function getLastModified()
    {
        return date('M jS (D)', filemtime($this->routesPath));
    }


    public function parseRoutes($path = '')
    {
        if (empty($path))
        {
            $path = $this->routesPath;
        }

        $routeLines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($routeLines === false)
        {
            return 'Something is wrong with routes.php file.';
        }

        $routesDocumented = [];
        $inDocBlock = false;
        $justOutOfTheBlock = false;
        $prefixes = [];

        foreach ($routeLines as &$line)
        {
            // if we have found the beginning of docblock, make note of it
            if (strpos($line, '/**') && !strpos($line, '*/')
             && !strpos($line, '/***') && !$inDocBlock && !$justOutOfTheBlock)
            {
                $newRoute = [];
                $inDocBlock = true;
            }
            // if we have found the end of the docblock, skip the line and parse the method
            else if (strpos($line, '*/') && $inDocBlock)
            {
              $justOutOfTheBlock = true;
            }
            // if we have done processing the block, close it and submit to the final array
            else if ($justOutOfTheBlock == true)
            {
                if (preg_match('/(any|get|post|put|patch|delete)\((\'|\")(.*?)(\'|\")/i', $line, $matches))
                {
                    //get or post method (or any)
                    $newRoute['method'] = strtoupper($matches[1]);

                    if (!empty($prefixes))
                    {
                        $newRoute['path'] = '/' . implode('/', $prefixes) . '/' . $matches[3];
                    }
                    else
                    {
                        $newRoute['path'] = '/' . $matches[3];
                    }
                }

                if (isset($newRoute))
                {
                    $routesDocumented[] = $newRoute;
                    unset($newRoute);
                }
                $inDocBlock = false;
                $justOutOfTheBlock = false;
            }
            // if we are somewhere inside the docblock, the magic happens
            else if ($inDocBlock && strpos($line, '*'))
            {
                $line = preg_replace('/\*/', '', $line, 1);
                $line = trim($line);

                //read docblock structure one line at the time
                if (!empty($line))
                {
                    if (starts_with($line, '@'))
                    {
                        if (preg_match('/^@(\w*?)\s(.*?)$/i', $line, $matches))
                        {
                            $tag = strtolower($matches[1]);
                            $value = $matches[2];
                        }

                        if(in_array($tag, ['group', 'title', 'description'])) {
                            $newRoute[$tag] = $value;
                        } else {
                            $newRoute[$tag][] = $value;
                        }
                    }
                    else if (!isset($newRoute['title']))
                    {
                        $newRoute['title'] = $line;
                    }
                    else if (!isset($newRoute['description']))
                    {
                        $newRoute['description'] = $line;
                    }
                }
            }
            // if we have prefix statement, save it
            else if (!$inDocBlock && preg_match('/(\'|\")prefix(\'|\") => (\'|\")([\w\/]*?)(\'|\")/i', $line, $matches))
            {
                array_push($prefixes, $matches[4]);
            }
            // if group ends, remove last prefix
            else if (!$inDocBlock && str_contains($line, '});'))
            {
                array_pop($prefixes);
            }
        }

        $routesGrouped = [];

        foreach ($routesDocumented as $route)
        {
            if (!empty($route))
            {
               $routesGrouped[$route['group']][] = $route;
            }
        }
        return $routesGrouped;
    }
}

<?php
namespace Paplauskas\ApiDocs\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiDocsController extends Controller
{

    private $config;

    public function __construct()
    {
        /**
         * Reads config file.
         * If there's no user defined configuration in config/apidocs.php, default config is used.
         */
        $this->config = config('apidocs');
        $this->path = app_path($this->config['routes']);
    }

    /**
     * Display a listing of different methods available to frondend.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->session()->get('ApiDocsPassword') !== $this->config['password'])
        {
            return redirect('apidocs/login');
        }

        $apiData = $this->parseRoutes();
        $lastModified = date('M jS (D)', filemtime($this->path));
        $title = $this->config['title'];

        return view('apidocs::index', compact('apiData', 'lastModified', 'title'));
    }

    public function login()
    {
        $title = $this->config['title'];

        return view('apidocs::login', compact('title'));
    }

    public function check(Request $request)
    {
        if ($request->has('password'))
        {
            $password = $request->get('password');

            if ($password === $this->config['password'])
            {
                $request->session()->set('ApiDocsPassword', $password);
            }
        }
        return redirect('apidocs');
    }

    public function logout(Request $request)
    {
        if ($request->session()->has('ApiDocsPassword'))
        {
            $request->session()->forget('ApiDocsPassword');
        }
        return redirect('apidocs/login');
    }

    /**
     * Parses routes.php file, gets DocBlock comments for routes.
     * @param type $path to the routes.php (optional)
     * @return array
     */
    private function parseRoutes($path = '')
    {
        if (empty($path))
        {
            $path = $this->path;
        }

        $routeLines = file($path);
        if ($routeLines === false)
        {
            return 'Something went wrong, routes.php not found.';
        }

        $routeLines = str_replace(["\t", "\n", "\r"], "", $routeLines);

        $routesDocumented = [];
        $inDocBlock = false;
		$prefixes = [];

        foreach ($routeLines as &$line)
        {
            // if we have found the beginning of docblock, make note of it
            if (str_contains($line, '/**') && !str_contains($line, '*/')
             && !str_contains($line, '/***') && !$inDocBlock)
            {
                $newRoute = [];
                $inDocBlock = true;

            }
            // if we have found the end of the docblock, close it and submit to the final array
            else if (str_contains($line, '*/') && $inDocBlock)
            {
                //foreach sets internal array pointer to the next item before current execution - dont ask my why
                $nextLine = current($routeLines);

                if (preg_match('/(any|get|post|put|patch|delete)\((\'|\")(.*?)(\'|\")/i', $nextLine, $matches))
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
            }
            // if we are somewhere inside the docblock, the magic happens
            else if ($inDocBlock && str_contains($line, '*'))
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
                        $newRoute[$tag] = $value;
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
            else if (!$inDocBlock && preg_match('/(\'|\")prefix(\'|\") => (\'|\")(\w*?)(\'|\")/i', $line, $matches))
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

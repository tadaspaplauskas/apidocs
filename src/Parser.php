<?php
namespace Paplauskas\ApiDocs;

use Paplauskas\ApiDocs\Endpoint;

class Parser
{
    public $paths;

    public function __construct()
    {
        $base = __DIR__ . '/../../../../';

        $this->paths = [
            $base . 'routes/api.php',
            $base . 'routes/web.php',
            $base . 'app/Http/routes.php',
        ];
    }

    public function getLastModified()
    {
        // find the most recent modified file date
        $mostRecent = 0;

        foreach ($this->paths as $path) {
            if (!file_exists($path))
                continue;

            $modified = filemtime($path);

            if ($modified > $mostRecent)
                $mostRecent = $modified;
        }

        return date('M jS (D)', $mostRecent);
    }

    public function parseEndpoints()
    {
        $lines = $this->getLines();

        if (empty($lines)) {
            return 'Something\'s wrong with routing files.';
        }

        $documentedEndpoints = [];
        $endpoint = null;

        // iterate through array with pointer functions
        // foreach would introduce unwanted complications here
        reset($lines);

        while($line = next($lines)) {
            // we have found the beginning of a new docblock
            if (!$endpoint && $this->firstLineOfDocBlock($line)) {
                $endpoint = new Endpoint();
            }

            // we have found the end of the docblock
            elseif ($endpoint && $this->lastLineOfDocBlock($line)) {
                // route declaration is expected to be on the next line
                $this->parseRouteDeclaration($endpoint, next($lines));

                // store it for display and close
                array_push($documentedEndpoints, $endpoint);
                $endpoint = null;
            }

            // we are somewhere inside the docblock - go looking for info
            elseif ($endpoint && $this->insideDocBlock($line)) {
                $this->parseTags($endpoint, $line);
            }

            // we have found a prefix statement - store it
            elseif (!$endpoint && $prefix = $this->parsePrefix($line)) {
                Endpoint::pushPrefix($prefix);
            }

            // end of group
            elseif (!$endpoint && str_contains($line, '});')) {
                Endpoint::popPrefix();
            }
        }

        return $this->groupEndpoints($documentedEndpoints);
    }

    public function getLines() {
        $array = [];

        foreach ($this->paths as $path) {
            if (!file_exists($path))
                continue;

            $current = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            $array = array_merge($array, $current);
        }

        return $array;
    }

    public function firstLineOfDocBlock($line)
    {
        return strpos($line, '/**') !== false
            && strpos($line, '*/') === false
            && strpos($line, '/***') === false;
    }

    public function lastLineOfDocBlock($line)
    {
        return strpos($line, '*/') !== false;
    }

    public function insideDocBlock($line)
    {
        return strpos($line, '*') !== false;
    }

    // get endpoint by reference
    public function parseRouteDeclaration(&$endpoint, $line)
    {
        if (preg_match('/(any|get|post|put|patch|delete)\((\'|\")(.*?)(\'|\")/i', $line, $matches)) {

            $endpoint->setMethod($matches[1]);
            $endpoint->setPath($matches[3]);
        }
    }

    public function parsePrefix($line)
    {
        preg_match('/(\'|\")prefix(\'|\") => (\'|\")([\w\/]*?)(\'|\")/i', $line, $matches);

        return isset($matches[4]) ? $matches[4] : null;
    }

    public function groupEndpoints($endpoints)
    {
        foreach ($endpoints as $endpoint)
        {
            if (!empty($endpoint))
            {
               $grouped[$endpoint->group][] = $endpoint;
            }
        }

        return $grouped;
    }

    public function parseTags(&$endpoint, $line)
    {
        $line = trim(preg_replace('/\*/', '', $line, 1));

        if (empty($line)) {
            return null;
        }

        if ($line[0] === '@') {
            // matching @tags
            if (preg_match('/^@(\w*?)\s(.*?)$/i', $line, $matches)) {
                $tag = strtolower($matches[1]);
                $value = $matches[2];

                // check if tag is valid, store it to endpoint
                if (Endpoint::isTag($tag)) {
                    $fn = 'set' . $tag;

                    $endpoint->$fn($value);
                }
            }
        } elseif (!$endpoint->getTitle()) { // by default
            $endpoint->setTitle($line);
        } elseif (!$endpoint->getDescription()) { // also by default
            $endpoint->setDescription($line);
        }
    }

}

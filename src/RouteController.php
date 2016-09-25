<?php
namespace Paplauskas\ApiDocs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Paplauskas\ApiDocs\Parser;

class RouteController extends Controller
{
    public function index(Request $request)
    {
        $parser = new Parser();

        $apiData = $parser->parseRoutes();
        $lastModified = $parser->getLastModified();

        return view('apidocs::index', compact('apiData', 'lastModified'));
    }
}

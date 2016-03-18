
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>{{ $title }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="modal-dialog">
            <h1 class="text-center">{{ $title }}</h1>
            <form class="form col-md-12 center-block" method="POST" action="/apidocs/check">
			  {!! csrf_field() !!}
              <div class="form-group">
                <input type="password" name="password" class="form-control input-lg" placeholder="Password">
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-lg btn-block">Sign In</button>
              </div>
            </form>
    </div>
    </body>
</html>
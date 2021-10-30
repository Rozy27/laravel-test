<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">

    <title>Toko Online | {{$_title}}</title>
  </head>
  <body>

    @include('partials.navbar')
    <section class="content-header mt-2">
      <h1>&nbsp;</h1>
    </section>

    <div class="container-fluid mt-4 mb-4">
      @yield('container')
    </div>
    <script src="/bootstrap/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
      function hanyanumerik(id, value) {
          if (/([^0123456789]|)/g.test(value)) { 
              $("#"+id).val(value.replace(/([^.0123456789])/g, ''));
          }
      }
    </script>
  </body>
</html>

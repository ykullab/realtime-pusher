@php
     $rtl = (LaravelLocalization::getCurrentLocale() ) == "ar"? "rtl" : "";

@endphp

<!doctype html>
<html lang="en">

@include("admin.partials.head")
 
  <body class="vertical  light {{ $rtl }}">
    <div class="wrapper">
    @include("admin.partials.navbar");
      @include("admin.partials.sidebar")
      <main role="main" class="main-content">
      @yield("content")
      </main> <!-- main -->
    </div> <!-- .wrapper -->
  @include("admin.partials.scripts")
  </body>
</html>
<!DOCTYPE html>
<html lang="en">

@include('partials._head')
  <body>
    @include('partials._nav')

    <div class="container">
    <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Log out</a>
    <form id="logout-form" action="{{route('logout')}}" method="POST">
    {{csrf_field()}}
    </form>
    @include('partials._messages')

    @yield('content')

    @include('partials._footer')
  
    </div><!--end of container -->
    
    @include('partials._javascript')


    @yield('scripts')
  </body>
</html>

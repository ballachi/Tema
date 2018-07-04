<!-- bara de vigare care contine lincuri catre alte pagini -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/')}}">Home</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/tag') }}">Tags</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/uploadfile') }}">Add todo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/edittodo') }}">Edit Todo</a>
      </li>
      </ul>
    </div>
  </div>
</nav>
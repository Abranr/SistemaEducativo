<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.72.0">
  <title>Dashboard Template · Bootstrap</title>

  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/dashboard/">



  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
    integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
    crossorigin="anonymous"></script>

</head>

<body>

  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="../index.php">Menu</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
      data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../index.php">
                <span data-feather="home"></span>
                Panel Principal
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Estudiante/consultar-estudiante.php">
                <span data-feather="file"></span>
                Estudiantes
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Cursos/cursos.php">
                <span data-feather="shopping-cart"></span>
                Cursos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Profesores/profesores.php">
                <span data-feather="users"></span>
                Profesores
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Inscripciones/inscripciones.php">
                <span data-feather="bar-chart-2"></span>
                Inscripciones
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Notas/notas.php">
                <span data-feather="layers"></span>
                Notas
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Horarios/horarios.php">
                <span data-feather="layers"></span>
                Horarios
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Acciones</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="./Estudiante/crear-estudiante.php">
                <span data-feather="file-text"></span>
                Crear Estudiante
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Estudiante/consultar-estudiante.php">
                <span data-feather="file-text"></span>
                Consultar Estudiante
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Estudiante/actualizar-estudiante.php">
                <span data-feather="file-text"></span>
                Actualizar Estudiante
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Estudiante/eliminar-estudiante..php">
                <span data-feather="file-text"></span>
                Eliminar Estudiante
              </a>
            </li>
          </ul>
        </div>
      </nav>
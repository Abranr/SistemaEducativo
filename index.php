    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema de Gestión de Notas Educativas</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">
        <!-- Custom CSS -->
        <style>
            body {
                background-color: #0D1C26;
                font-family: 'Roboto', sans-serif;
            }
            .sidebar {
                background-color: #F2F2F2;
                color: #050B0D;
                transition: background-color 0.3s ease-in-out;
            }

            .sidebar .nav-link {
                color: #0D0D0D;
                transition: color 0.3s ease-in-out;
            }

            .sidebar .nav-link.active {
                color: #FFFFFF;
                background-color: #050B0D;
            }

            .sidebar .nav-link:hover {
                color: #FFFFFF;
                background-color: #050B0D;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                transform: scale(1.05);
                transition: background-color 0.3s ease, transform 0.2s ease;
            }

            .card {
                border: none;
                border-radius: 15px;
                transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
                overflow: hidden;
                color: #FFFFFF;
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            }

            .card.card-1 {
                background-color: #3498DB; /* Azul */
            }

            .card.card-2 {
                background-color: #E74C3C; /* Rojo */
            }

            .card.card-3 {
                background-color: #2ECC71; /* Verde */
            }

            .card:hover {
                transform: translateY(-10px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }

            .card-header {
                background: none; /* Elimina el degradado del encabezado */
                border-bottom: none;
                padding: 1rem;
                text-align: center;
            }

            .card-header i {
                font-size: 2.5rem;
            }

            .card-body {
                padding: 1.5rem;
                text-align: center;
            }

            .card-body h5 {
                margin-bottom: 1rem;
            }

            .btn-primary {
                background-color: #3498DB;
                border: none;
                transition: background-color 0.3s ease;
            }

            .btn-primary:hover {
                background-color: #2980B9;
            }
            .descargas {
            padding: 2rem;
        }
        .button {
            display: inline-block;
            margin: 1rem;
            border: none;
            background-color: #3498DB; /* Azul */
            border-radius: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .button:hover {
            background-color: #2980B9;
            transform: scale(1.05);
        }
        .button a {
            color: #FFFFFF;
            text-decoration: none;
            display: block;
            padding: 1rem;
            text-align: center;
        }
        .button_text {
            font-size: 1rem;
            font-weight: 500;
        }
        .button_lg {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        </style>
    </head>
    <body>
        <?php include './includes/header.php'; ?>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./index.php">
                                    <i class="fas fa-home"></i>
                                    Menu Principal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./Estudiante/crear-estudiante.php">
                                    <i class="fas fa-user-graduate"></i>
                                    Estudiantes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./Cursos/cursos.php">
                                    <i class="fas fa-book"></i>
                                    Cursos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./Profesores/profesores.php">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    Profesores
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./Estudiante/crear-estudiante.php">
                                    <i class="fas fa-clipboard-list"></i>
                                    Inscripciones
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./Notas/notas.php">
                                    <i class="fas fa-graduation-cap"></i>
                                    Notas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./Horarios/horarios.php">
                                    <i class="fas fa-clock"></i>
                                    Horarios
                                </a>
                            </li>
                        </ul>
                        

                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Estudiantes</span>
                            <a class="link-secondary" href="#" aria-label="Add a new report">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link" href="./Estudiante/crear-estudiante.php">
                                    <i class="fas fa-plus"></i>
                                    Crear Estudiante
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./Estudiante/consultar-estudiante.php">
                                    <i class="fas fa-search"></i>
                                    Consultar Estudiante
                                </a>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Gestión de Estudiantes</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Compartir</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Exportar</button>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                <i class="fas fa-calendar"></i>
                                Esta semana
                            </button>
                        </div>
                    </div>
                    <div class="row">
        <div class="col-md-4">
            <div class="card card-1 mb-4">
                <div class="card-header">
                    <i class="fas fa-users"></i> <!-- Nuevo ícono -->
                    <h4 class="my-0 font-weight-normal">Estudiantes</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Consultar Estudiantes</h5>
                    <p class="card-text">Se mostrará el despliegue de los estudiantes.</p>
                    <a href="./Estudiante/consultar-estudiante.php" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-2 mb-4">
                <div class="card-header">
                    <i class="fas fa-calendar-alt"></i> <!-- Nuevo ícono -->
                    <h4 class="my-0 font-weight-normal">Cursos</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Consultar los Cursos</h5>
                    <p class="card-text">Se mostrará el despliegue de los Cursos</p>
                    <a href="./Cursos/consultar-cursos.php" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-3 mb-4">
                <div class="card-header">
                    <i class="fas fa-chalkboard"></i> <!-- Nuevo ícono -->
                    <h4 class="my-0 font-weight-normal">Profesores</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Consultar los Profesores</h5>
                    <p class="card-text">Se mostrará el despliegue de los Profesores</p>
                    <a href="./Profesores/consultar-profesores.php" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-2 mb-4">
                <div class="card-header">
                    <i class="fas fa-sign-in-alt"></i>
                    <h4 class="my-0 font-weight-normal">Inscripciones</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Consultar Inscripciones</h5>
                    <p class="card-text">Se mostrará el despliegue de las Incripciones</p>
                    <a href="./Estudiante/consultar-estudiante.php" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-3 mb-4">
                <div class="card-header">
                    <i class="fas fa-file-alt"></i>
                    <h4 class="my-0 font-weight-normal">Notas</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Consultar Notas</h5>
                    <p class="card-text">Se mostrará el despliegue de las notas</p>
                    <a href="./Notas/Consultar-Notas.php" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card  card-1 mb-4">
                <div class="card-header">
                    <i class="fas fa-clock"></i>
                    <h4 class="my-0 font-weight-normal">Horarios</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Consultar Horarios</h5>
                    <p class="card-text">Se mostrará el despliegue de los horarios</p>
                    <a href="./Horarios/consultar-horarios.php" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <section class="descargas text-center">
            <button class="button">
                <span class="button_lg">
                    <a href="./Docs/Manual de Usuario F.pdf" download="Manual de Usuario" target="_blank">
                        <span class="button_text">Descargar Manual de Usuario</span>
                    </a>
                </span>
            </button>
            <button class="button">
                <span class="button_lg">
                    <a href="./Docs/Manual Tecnico F.pdf" download="Manual Tecnico target="_blank">
                        <span class="button_text">Descargar Manual Técnico</span>
                    </a>
                </span>
            </button>
        </section>
    </div>

                </main>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    </body>
    </html>

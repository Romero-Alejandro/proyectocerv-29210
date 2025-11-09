<?php

// Controlador para manejar todas las operaciones de gestión de categorías
class categoryController extends Controller
{

  // Título específico para este controlador
  protected $title = 'Gestión de Categorías';

  /**
   * Página principal - Muestra la lista de categorías y el formulario de añadir.
   */
  public function index()
  {
    try {

      $categories = categoryModel::getAllWithTaskCount();

      $data = [
        'page_title' => $this->title,
        'categories' => $categories
      ];

      View::render('categoryList', $data);
    } catch (Exception $e) {

      $data = (object) [
        'titulo' => 'Error al cargar categorías. Revise la conexión a la base de datos y el método getAllWithTaskCount().',
        'mensaje' => $e->getMessage()
      ];

      View::render('error', $data);
    }
  }

  /**
   * Procesar formulario de nueva categoría (POST)
   */
  public function store()
  {

    if (!$this->validatePost(['name'])) {

      $this->redirectWithMessage('category', 'Debe ingresar un nombre para la categoría.', 'warning');
      return;
    }

    $categoryData = [
      'name' => trim($_POST['name']),
      'color' => $_POST['color'] ?? '#0d6efd',
    ];

    categoryModel::create($categoryData);

    $this->redirectWithMessage('category', 'Categoría agregada exitosamente.', 'success');
  }




  /**
   * Mostrar formulario para agregar nueva categoría
   */
  function add()
  {

    $categories = CategoryModel::getAllCategories();

    $data = [
      'page_title' => 'Agregar Categoría',
      'categories' => $categories
    ];


    View::render('addCategory', $data);
  }

  /**
   * Mostrar formulario para editar categoría existente
   */
  function edit()
  {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $this->redirectWithMessage('category', 'ID de categoría inválido', 'danger');
      return;
    }

    $id = $_GET['id'];
    $category = categoryModel::find($id);

    if (!$category) {
      $this->redirectWithMessage('category', 'Categoría no encontrada', 'danger');
      return;
    }

    $data = [
      'page_title' => 'Editar Categoría',
      'category' => $category
    ];

    View::render('editCategory', $data);
  }



  /**
   * Procesar formulario de edición de categoría (POST)
   */
  public function update()
  {
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
      $this->redirectWithMessage('category', 'ID de categoría inválido.', 'danger');
      return;
    }

    if (!$this->validatePost(['name'])) {
      $this->redirectWithMessage('category', 'Debe ingresar un nombre para la categoría.', 'warning');
      return;
    }

    $id = $_POST['id'];

    $category = categoryModel::find($id);
    if (!$category) {
      $this->redirectWithMessage('category', 'Categoría no encontrada.', 'danger');
      return;
    }

    $categoryData = [
      'name' => trim($_POST['name']),
      'color' => trim($_POST['color'])
    ];


    categoryModel::update($id, $categoryData);

    $this->redirectWithMessage('category', 'Categoría actualizada exitosamente.', 'success');
  }

  /**
   * Eliminar una categoría (GET)
   */
  public function delete()
  {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $this->redirectWithMessage('category', 'ID de categoría inválido.', 'danger');
      return;
    }

    $id = $_GET['id'];


    $category = categoryModel::find($id);
    if (!$category) {
      $this->redirectWithMessage('category', 'Categoría no encontrada.', 'danger');
      return;
    }


    categoryModel::delete($id);

    $this->redirectWithMessage('category', 'Categoría eliminada exitosamente.', 'info');
  }
}

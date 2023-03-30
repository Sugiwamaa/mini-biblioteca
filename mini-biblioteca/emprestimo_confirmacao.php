<?php
require_once('conexao.php');
if (empty($_POST['id_livro']) || empty($_POST['id_usuario'])) {
  header('Location: index.php');
}
$id_livro = $_POST['id_livro'];
$id_usuario = $_POST['id_usuario'];
$sql_livro = "SELECT * FROM Livros WHERE id = $id_livro AND status = 1";
$resultado_livro = $conexao->query($sql_livro);
if ($resultado_livro->num_rows != 1) {
  header('Location: index.php');
}
$sql_usuario = "SELECT * FROM usuarios WHERE id = $id_usuario";
$resultado_usuario = $conexao->query($sql_usuario);
if ($resultado_usuario->num_rows != 1) {
  header('Location: index.php');
}
$data_emprestimo = date('Y-m-d');
$data_devolucao = date('Y-m-d', strtotime('+7 days'));
$sql_emprestimo = "INSERT INTO emprestimos (id_usuario, id_livro, data_emprestimo, data_devolucao) VALUES ($id_usuario, $id_livro, '$data_emprestimo', '$data_devolucao')";
$conexao->query($sql_emprestimo);
$sql_livro_emprestado = "UPDATE livros SET status = 0 WHERE id = $id

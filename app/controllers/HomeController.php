<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class HomeController extends Controller{

    public function index(){

        $imovelModel = new Imovel();
        $imoveis = $imovelModel->getTodosImoveis();

        $dados = [];
        $dados['imoveis'] = $imoveis;

        $this->carregarViews('home', $dados);
    }

  public function enviarContato()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefone = $_POST['telefone'] ?? '';
        $mensagem = $_POST['mensagem'] ?? '';

        require_once 'caminho/para/PHPMailer/src/Exception.php';
        require_once 'caminho/para/PHPMailer/src/PHPMailer.php';
        require_once 'caminho/para/PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP do Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'SEU_EMAIL@gmail.com';
            $mail->Password = 'SENHA_DO_APP'; // Use senha de app do Gmail
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($email, $nome);
            $mail->addAddress('felipetremetreme111@gmail.com');
            $mail->Subject = 'Contato pelo site Tanamão Imóveis';
            $mail->Body = "Nome: $nome\nEmail: $email\nTelefone: $telefone\nMensagem:\n$mensagem";

            $mail->send();
            $_SESSION['msg_contato'] = "Mensagem enviada com sucesso!";
        } catch (Exception $e) {
            $_SESSION['msg_contato'] = "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        }
        header('Location: ' . URL_BASE . 'home');
        exit;
    }
}
}
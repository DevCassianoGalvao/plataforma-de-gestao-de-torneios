<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Services\AuditService;
use App\Services\PasswordResetService;
use App\Support\Database;
use App\Support\Security;
use App\Support\Session;
use App\Support\View;

final class AuthController {
    public function login(): string { return View::render('auth/login',['title'=>'Entrar']); }
    public function authenticate(): never { Security::verifyCsrf($_POST['_csrf']??null); $email=filter_var(trim((string)($_POST['email']??'')),FILTER_VALIDATE_EMAIL); $db=Database::connection(); $ip=$_SERVER['REMOTE_ADDR']??null; $rate=$db->prepare('SELECT COUNT(*) FROM login_attempts WHERE ip_address=? AND success=0 AND created_at >= (NOW() - INTERVAL 15 MINUTE)'); $rate->execute([$ip]); if ((int)$rate->fetchColumn() >= 10) { Session::flash('error','Muitas tentativas. Aguarde alguns minutos.'); Security::redirect('/login'); } $s=$db->prepare('SELECT u.*,r.role_key FROM users u LEFT JOIN user_role_assignments a ON a.user_id=u.id AND a.deleted_at IS NULL LEFT JOIN roles r ON r.id=a.role_id WHERE u.email=? AND u.deleted_at IS NULL LIMIT 1'); $s->execute([$email ?: '']); $user=$s->fetch(); if (!$user || !password_verify((string)($_POST['password']??''),(string)$user['password_hash'])) { $db->prepare('INSERT INTO login_attempts (email,ip_address,success,created_at) VALUES (?,?,0,NOW())')->execute([(string)($_POST['email']??''),$ip]); Session::flash('error','E-mail ou senha inválidos.'); Security::redirect('/login'); } Session::login($user); $db->prepare('INSERT INTO login_attempts (email,ip_address,success,created_at) VALUES (?,?,1,NOW())')->execute([$email,$ip]); AuditService::record('login','users',(int)$user['id']); Security::redirect('/admin'); }
    public function logout(): never { $u=Session::user(); if ($u) AuditService::record('logout','users',(int)$u['id']); Session::logout(); Security::redirect('/login'); }
    public function forgotPassword(): string { return View::render('auth/forgot-password',['title'=>'Recuperar senha']); }
    public function requestPasswordReset(): never { Security::verifyCsrf($_POST['_csrf']??null); $email=filter_var(trim((string)($_POST['email']??'')),FILTER_VALIDATE_EMAIL); if($email){$token=(new PasswordResetService(Database::connection()))->request($email);if($token)error_log('Password reset URL: '.rtrim((string)\App\Support\Env::get('APP_URL',''),'/').'/senha/redefinir/'.$token);} Session::flash('success','Se o e-mail estiver cadastrado, instruções de recuperação foram enviadas.'); Security::redirect('/login'); }
    public function resetPasswordForm(array $p): string { return View::render('auth/reset-password',['title'=>'Redefinir senha','token'=>$p['token']]); }
    public function resetPassword(): never { Security::verifyCsrf($_POST['_csrf']??null); $token=(string)($_POST['token']??'');try{$userId=(new PasswordResetService(Database::connection()))->reset($token,(string)($_POST['password']??''));AuditService::record('password_reset','users',$userId);Session::flash('success','Senha redefinida. Entre com a nova senha.');Security::redirect('/login');}catch(\RuntimeException $e){Session::flash('error',$e->getMessage());Security::redirect('/senha/redefinir/'.$token);} }
}

<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Services\PublicPortalPresenter;use App\Support\Database;use App\Support\View;
final class PublicController {
 private function presenter():PublicPortalPresenter{return new PublicPortalPresenter(Database::connection());}
 public function tournament(array $p):string{return $this->page($p,'home');}
 public function section(array $p):string{return $this->page($p,$p['page']);}
 public function detail(array $p):string{return $this->page($p,$p['page'],(int)$p['id']);}
 private function page(array $p,string $page,?int $id=null):string{$portal=$this->presenter();$t=$portal->tournament($p['slug']);if(!$t)return$this->notFound();$allowed=['home','jogos','jogo','classificacao','grupos','mata-mata','equipes','equipe','atletas','atleta','artilharia','assistencias','cartoes','suspensoes','rankings','noticias','galerias','vai-e-vem','regulamento','documentos','campeoes','patrocinadores'];if(!in_array($page,$allowed,true))return$this->notFound();$data=['matches'=>$portal->matches((int)$t['id']),'standings'=>$portal->standings((int)$t['id']),'teams'=>$portal->teams((int)$t['id']),'athletes'=>$portal->athletes((int)$t['id']),'rankings'=>$portal->rankings((int)$t['id']),'news'=>$portal->content((int)$t['id'],'noticias'),'galleries'=>$portal->content((int)$t['id'],'galerias'),'transfers'=>$portal->content((int)$t['id'],'vai-e-vem'),'documents'=>$portal->content((int)$t['id'],'documentos'),'champions'=>$portal->content((int)$t['id'],'campeoes'),'sponsors'=>$portal->content((int)$t['id'],'patrocinadores')];if($page==='jogo')$data['detail']=$portal->match((int)$t['id'],(int)$id);if($page==='equipe')$data['detail']=$portal->team((int)$t['id'],(int)$id);if($page==='atleta')$data['detail']=$portal->athlete((int)$t['id'],(int)$id);if(in_array($page,['jogo','equipe','atleta'],true)&&empty($data['detail']))return$this->notFound();return View::render('public/portal',['title'=>$t['name'].' | '.ucfirst($page),'tournament'=>$t,'theme'=>$portal->theme((int)$t['id']),'page'=>$page,'data'=>$data]);}
 private function notFound():string{http_response_code(404);return View::render('errors/404',['title'=>'Pagina nao encontrada']);}
}

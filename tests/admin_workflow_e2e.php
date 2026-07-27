<?php
declare(strict_types=1);
require dirname(__DIR__).'/app/bootstrap.php';

$view=(string)file_get_contents(dirname(__DIR__).'/app/Views/admin/tournament-operations.php');
$controller=(string)file_get_contents(dirname(__DIR__).'/app/Controllers/TournamentOperationController.php');
foreach(['players_json','name="match_id" type="number"','name="team_id" type="number"','name="person_id" type="number"'] as $forbidden) if(str_contains($view,$forbidden)) throw new RuntimeException('Technical input exposed: '.$forbidden);
foreach(['name="team_id"','name="person_id"','name="stage_id"','name="group_id"','name="registration_id"','name="match_id"'] as $guided) if(!str_contains($view,$guided)) throw new RuntimeException('Guided workflow field missing: '.$guided);
foreach(['requireTournamentPermission','matchAccess','relation($tid,\'registration\'','relation($tid,\'group\'','Security::verifyCsrf'] as $guard) if(!str_contains($controller,$guard)) throw new RuntimeException('Controller protection missing: '.$guard);
echo "ADMIN_WORKFLOW_E2E_OK\n";

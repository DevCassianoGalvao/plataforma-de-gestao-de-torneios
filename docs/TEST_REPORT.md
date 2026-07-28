# Relatório de Testes

## Definitive release audit - 27/07/2026

- Full available regression passed: `FULL_AUDIT_REGRESSION_OK` (lint plus 13 PHP test scripts).
- This result is insufficient for production: `http_authenticated_e2e.php` is source-level control verification, not authenticated HTTP integration. Refer to `docs/FINAL_RELEASE_AUDIT.md` for the release decision.

## Production preparation - 27/07/2026

- Clean install approved: `powershell.exe -ExecutionPolicy Bypass -File bin/clean-install.ps1 -DatabaseName torneios_test_disposable` created disposable DB, ran migrations 001-017, seeded, ran integration and removed DB.
- `tests/clean_install_e2e.php`, `tests/security_e2e.php`, `tests/http_authenticated_e2e.php`: approved.
- Important limitation: HTTP authenticated test currently verifies application controls statically; browser/socket login, logout and CSRF exchange remains pending.

## Accountability and exports - 27/07/2026

- `php tests/accountability_e2e.php`: approved (`ACCOUNTABILITY_E2E_OK`). Covers published news/gallery persistence, dashboard metrics, CSV job and ZIP job output.

## Public portal - 27/07/2026

- `php tests/public_portal_e2e.php`: approved (`PUBLIC_PORTAL_E2E_OK`). Covers published slugs, private-field absence, draft championship hiding, team page and 404.

## Rectification - 27/07/2026

- `php tests/rectification_e2e.php`: approved (`RECTIFICATION_E2E_OK`). Covers immutable snapshot, request, approval, impact decision requirement and transactional application.

## Advanced sports rules - 27/07/2026

- `php tests/sports_rules_e2e.php`: approved (`SPORTS_RULES_E2E_OK`). Covers configured W.O., standings points, point penalty/revocation, yellow-card suspension, lineup block and suspension fulfillment.

## Assisted administrative workflow - 27/07/2026

- `php tests/admin_workflow_e2e.php`: approved (`ADMIN_WORKFLOW_E2E_OK`). It guards against manual technical inputs and JSON lineup input, verifies controller CSRF/scope checks, persists assisted team/athlete/staff creation and rejects registering an athlete into a different team.

## Authorization and scope - 27/07/2026

- `php tests/authorization_e2e.php`: approved (`AUTHORIZATION_E2E_OK`), including cross-project, tournament, team, match, athlete and private-document IDOR cases.
- `php tests/tournament_e2e.php`, PHP lint, migrations 013-015, `tests/integration.php` and `tests/smoke.php`: approved after authorization changes.
- Authenticated HTTP login/session/CSRF/403/404 remains a real pending test.

## Seed demo - 27/07/2026

- `php database/seed.php --demo`: aprovado duas vezes consecutivas.
- `php tests/demo_seed.php`: aprovado (`DEMO_SEED_OK`), incluindo bloqueio em `APP_ENV=production`.
- Dados validados: 3 campeonatos, 16 equipes, 288 atletas fictícios, 35 integrantes de comissão, 20 usuários `@example.com`, regulamentos, grupos, eventos, classificação, mata-mata, arquivos e escopo de equipe.
- O algoritmo round-robin foi corrigido: grupos ímpares agora geram confrontos de todas as equipes sem repetição estrutural.
- Smoke HTTP demo: os três portais por slug retornaram `200`.

## Fluxo operacional mínimo - 27/07/2026

- `tests/tournament_e2e.php`: aprovado (`TOURNAMENT_E2E_OK`). Criou organização, projeto, campeonato, preset, 10 equipes, 70 atletas e inscrições aprovadas; distribuiu dois grupos; gerou e homologou 20 jogos; classificou quatro equipes por grupo; gerou, homologou e avançou quartas, semifinais e final; confirmou campeão e vice; gerou PDF da súmula final em `storage/private/reports`; validou isolamento entre campeonatos, escopo de equipe, operador sem permissão de homologar, retificação e portal público com dados homologados.
- Resultado mais recente: `TOURNAMENT_E2E_OK 37 private/reports/match-95-1eaaf18fe74b.pdf`.

## Ambiente

- PHP 8.2.12 (XAMPP), MySQL local e banco `torneios` existente.
- Execução de auditoria em 27/07/2026, sem apagar banco ou uploads existentes.

## Executados e aprovados

- Lint de todos os arquivos PHP em `app`, `bin`, `public` e `tests`: aprovado.
- `php bin/migrate.php`: aprovado na base atual, sem migrations pendentes.
- `php bin/seed.php`: aprovado.
- `php tests/integration.php`: aprovado (`REPOSITORY_CRUD_OK`). Cobre CRUD genérico, soft delete, paginação, upload com MIME permitido, reset de senha por serviço, escopo de download em dois campeonatos, auditoria básica, preset/versionamento, round-robin em memória, evento de gol/anulação e estrutura de PDF.
- `php tests/smoke.php`: aprovado (`PUBLIC_OK name`).
- HTTP anônimo: home, jogos e rankings retornaram 200; rota pública desconhecida retornou 404; URL direta para `storage/private` retornou 404; download administrativo sem sessão retornou 302 para login.
- Headers HTTP verificados: CSP, `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy` e `Permissions-Policy`.

## Não executados ou insuficientes

- Login HTTP autenticado, logout, recuperação, sessão e rate limit: o POST com credencial de desenvolvimento foi bloqueado pela política do executor, não pelo aplicativo. Não há teste automatizado equivalente.
- Fluxo administrativo completo e fluxo público completo: não executáveis porque as rotas e fluxos obrigatórios ainda não existem.
- CSRF, XSS, SQL injection, upload executável, IDOR em CRUDs, permissões granulares, isolamento de equipes, responsividade e instalação limpa: sem cobertura automatizada.
- PDF foi validado estruturalmente no gerador, não por renderizador externo.

## Conclusão

Os testes confirmam o fluxo operacional mínimo por serviços e rotas implementadas. Eles não comprovam todos os requisitos do PRD: interface assistida de cadastros, autorização em todo CRUD genérico, confronto direto, disciplina completa, reconstrução da chave após retificação e instalação limpa ainda requerem cobertura própria.

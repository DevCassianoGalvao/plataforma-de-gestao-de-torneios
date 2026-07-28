# Plano Executável do Sistema

## Final release audit - 27/07/2026

- [ ] Production release. Reopened: authenticated HTTP proof, complete assisted administration, safe rectification/PDF chain, complete sports rules, public SEO/responsive evidence and infrastructure validation. See `docs/FINAL_RELEASE_AUDIT.md`.

## Production preparation - 27/07/2026

- [x] Disposable clean installation runner, security-control checks, deployment, LGPD, backup and observability documentation.
- [ ] Real authenticated HTTP integration, external backup restore, SMTP and cPanel production-host verification remain pending.

## Accountability and exports update - 27/07/2026

- [x] Real accountability indicators and scoped CSV/ZIP export jobs are implemented; verified by `tests/accountability_e2e.php`.
- [ ] Assisted editorial, gallery, transfer and document workflows, report PDF and grouped archive downloads remain pending.

## Public portal update - 27/07/2026

- [x] Public presenter, championship slug home, lists and public match/team/athlete details use explicit permitted fields and hide draft championships; verified by `tests/public_portal_e2e.php`.
- [ ] Sitemap, robots, complete social metadata, public content details, full bracket visual and responsive browser verification remain pending.

## Advanced sports rules update - 27/07/2026

- [x] Configurable points, W.O. score, active point penalties, basic direct head-to-head, card ledger, automatic suspension, fulfillment and lineup block are implemented and covered by `tests/sports_rules_e2e.php`.
- [ ] Full three-team mini-table ordering, card reset by phase, substitution windows, extra time and operational penalty shootout remain pending.

## Administrative assisted workflow - 27/07/2026

- [x] Championship operational screen uses filtered selects and action forms for registrations, groups, schedule generation, visual lineups, match events, finish, homologation and PDF; no manual IDs or lineup JSON in primary flow.
- [x] Assisted team, athlete and technical-staff creation derives project/tournament from persisted context; athlete-team mismatch is blocked server-side.
- [ ] Photo/document upload, full athlete editing, operational match postponement/cancellation/W.O., schedule wizard with venues/days and bracket visualization remain pending.

## Authorization update - 27/07/2026

- [x] Granular permissions and organization/project/tournament/team/match isolation applied to generic CRUD and operational policies; verified by `tests/authorization_e2e.php`.
- [ ] Authenticated HTTP session, CSRF and response-code coverage remains pending.

## Atualização operacional - 27/07/2026

- [x] Fluxo mínimo comprovado por `tests/tournament_e2e.php`: inscrições aprovadas, grupos, agenda, escalações, eventos, homologação, classificação por grupo, quartas, semifinais, final, campeão, vice e PDF privado.
- [ ] O restante dos itens abaixo permanece aberto quando exigir interface assistida, controle completo de escopo em CRUD genérico ou regras esportivas ainda não implementadas.

Regra: um item só recebe `[x]` depois de comportamento real e verificação registrada em `docs/TEST_REPORT.md`.

## 1. Fundação e operação básica

- [x] Estrutura MVC, front controller, roteador e templates PHP.
- [x] Ambiente `.env`, PDO MySQL, migrations, seeds e runner PHP.
- [x] Erro centralizado, logs de exceção, CSRF, sessões seguras e soft delete base.
- [x] Timestamps automáticos em inserções de repositório.
- [ ] Validação e normalização de entrada por entidade no servidor. (Existe validador genérico; regras de domínio e relações ainda não são validadas.)
- [x] Paginação, filtros e busca reais nos CRUDs administrativos.
- [x] Upload seguro e armazenamento privado/público com validação de MIME e tamanho.
- [x] Download privado autorizado por permissão e escopo.
- [x] Documentação de instalação local e cPanel.

## 2. Autenticação, perfis e escopos

- [x] Login, logout, hash de senha, regeneração de sessão e rate limit.
- [x] Solicitação e redefinição de senha com token temporário.
- [x] Roles seedados: superadmin, projeto, organizador, time, operação, comunicação e auditoria.
- [ ] Permissões granulares por ação e perfil.
- [ ] Isolamento por organização, projeto, campeonato e equipe em consultas e rotas.
- [x] Auditoria de login, logout e mutações de CRUD.
- [ ] Auditoria de retificações, homologações e alterações de regulamento.

## 3. Multi-campeonato e regulamento

- [x] Organizações, projetos, campeonatos, slug, tema e configurações persistidas.
- [ ] Categorias, temporadas, patrocinadores, banners e logos com arquivos reais.
- [x] Preset configurável da Copa Brasil de Talentos persistido em JSON.
- [ ] Editor estruturado de grupos, pontuação, desempates, cartões, W.O., inscrição e mata-mata. (Há persistência JSON, mas não controles estruturados nem validação integral de todas as regras.)
- [x] Versionamento e bloqueio de regras após primeira partida.

## 4. Cadastros e inscrições

- [ ] CRUD de equipes, pessoas, vínculos e inscrições com regras de domínio. (Há CRUD genérico, sem fluxo de inscrição, relações assistidas ou validações exigidas.)
- [ ] Campos completos de atleta, responsável, comissão, posição, número, foto e documentos.
- [ ] Validação de duplicidade, faixa etária, limite de elenco e inscrição por categoria.
- [ ] Histórico de vínculo e movimentação de atleta.

## 5. Calendário e competição

- [x] Schema de fases, grupos, rodadas, locais, partidas e escalações.
- [ ] CRUD funcional de grupos, rodadas e distribuição de equipes.
- [ ] Geração configurável de fase de grupos, datas e horários.
- [ ] Adiamento, cancelamento, W.O. e decisões administrativas.
- [ ] Geração configurável de quartas, semifinais e final.
- [ ] Avanço automático de vencedor e tratamento de pênaltis.

## 6. Central de partida e súmula

- [x] Persistência de partidas, eventos, escalações e estados de súmula.
- [ ] Interface operacional da partida com cronologia, placar e correção de eventos.
- [ ] Titulares, reservas, comissão técnica e arbitragem validados.
- [ ] Homologação, retificação e histórico imutável de versões.
- [ ] Montagem de súmula digital completa.
- [ ] Geração de PDF individual, por rodada e por campeonato.

## 7. Estatísticas, classificação e disciplina

- [x] Serviço inicial de classificação por partidas homologadas.
- [ ] Pontuação e ordem de desempate lidas integralmente da configuração.
- [ ] Recálculo transacional após homologação e retificação.
- [ ] Artilharia, assistências, cartões, partidas e rankings automáticos.
- [ ] Cartões, pendurados, suspensões, cumprimento e bloqueio de escalação.
- [ ] Punições, perda de pontos e histórico administrativo.

## 8. Conteúdo e prestação de contas

- [x] Schema de notícias, galerias, transferências, documentos, premiações e export jobs.
- [ ] CRUD funcional com publicação, destaque, galerias e anexos.
- [ ] Fluxo completo de transferências, janela e publicação pública.
- [ ] Dashboard de prestação de contas e filtros por período.
- [ ] Exportação CSV, PDF, pacote de documentos e download agrupado.

## 9. Portal público

- [x] Home por slug, tema, jogos, classificação, equipes e notícias com dados reais.
- [ ] Página de detalhe de jogo, equipe e atleta.
- [ ] Grupos, chaveamento, artilharia, assistências, disciplina e rankings.
- [ ] Galerias, vai e vem, regulamento, documentos públicos e campeões.
- [ ] SEO, metadados sociais, estados de carregamento e acessibilidade revisada.

## 10. Qualidade e implantação

- [x] PHP lint, migrations, seed, smoke público e teste de CRUD de repositório.
- [ ] Testes de autenticação, CSRF, permissões e isolamento entre campeonatos.
- [ ] Testes de classificação, desempate, cartões, suspensão, mata-mata e retificação.
- [ ] Testes de interface responsiva e fluxo HTTP autenticado.
- [ ] CSP, headers de segurança, política LGPD, backup e observabilidade.
- [ ] Checklist de implantação cPanel validado em instalação limpa.

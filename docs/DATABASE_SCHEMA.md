# Schema inicial

Migration `001_foundation.sql` cria:

`organizations`, `projects`, `tournaments`, `tournament_settings`, `tournament_themes`, `users`, `roles`, `permissions`, `user_role_assignments`, `people`, `teams`, `team_tournament_entries`, `team_memberships`, `registrations`, `audit_logs`, `login_attempts`.

Todas as tabelas de negócio usam `status`, timestamps e exclusão lógica quando aplicável. Chaves estrangeiras impedem referências inválidas. Índices cobrem slug, e-mail, escopo e relações de campeonato.

`registrations` distingue `athlete` e `staff`; `people` guarda dados restritos e nunca é consultada diretamente pelo portal. `tournament_settings.settings_json` guarda formato, pontuação, desempates, mata-mata, cartões, W.O., elenco e publicação. `tournament_themes` guarda tokens permitidos light/dark.

Migration `002_competition_content.sql` adiciona `stages`, `groups_competition`, `rounds`, `venues`, `matches`, `match_lineups`, `match_events`, `match_reports`, `disciplinary_records`, `suspensions`, `standings_snapshots`, `news_posts`, `galleries`, `gallery_items`, `transfers`, `documents`, `awards`, `notifications` e `export_jobs`.

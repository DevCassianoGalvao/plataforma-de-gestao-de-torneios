# Rectification Flow

1. A homologation version stores match, events, lineups and officials as immutable JSON with SHA-256 integrity hash.
2. A request references the latest homologated version, reason and questioned fields.
3. Approval calculates downstream knockout/champion impact.
4. Applying creates a superseded snapshot. If later knockout matches started or a champion exists, an administrative decision is mandatory and automatic destructive rebuild is blocked.
5. Without downstream impact, standings and suspensions recalculate in the same transaction. A failure rolls back the request state and data changes.
6. Existing PDFs remain stored; the next homologation generates a new report path.

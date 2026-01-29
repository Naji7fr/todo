# Todo App — Laravel (Week 1)

Mini Todo-app voor het 8-weekse Laravel-ontwikkeltraject (MBO Software Developer).

## Wat zit erin (Week 1)

- **Model:** `Task` met `title`, `description`, `is_done`
- **CRUD:** aanmaken, overzicht, bewerken, verwijderen
- **Validatie** in de controller (title verplicht, description optioneel)
- **Mark as done:** toggle-knop op de lijst en op de detailpagina

## Vereisten

- PHP 8.2+
- Composer
- SQLite (standaard) of MySQL

## Installatie & starten

```bash
# Dependencies zijn al geïnstalleerd; bij een verse clone:
composer install

# .env is aanwezig; bij gebruik van MySQL pas DB_* in .env aan

# Migraties (al gedaan bij opzetten)
php artisan migrate

# Development server starten
php artisan serve
```

Open daarna **http://localhost:8000**. De startpagina redirect naar het takenoverzicht.

## Routes

| Methode | URL | Actie |
|--------|-----|--------|
| GET | `/` | Redirect naar takenoverzicht |
| GET | `/tasks` | Overzicht taken |
| GET | `/tasks/create` | Formulier nieuwe taak |
| POST | `/tasks` | Taak opslaan |
| GET | `/tasks/{id}` | Taak bekijken |
| GET | `/tasks/{id}/edit` | Formulier taak bewerken |
| PUT | `/tasks/{id}` | Taak bijwerken |
| DELETE | `/tasks/{id}` | Taak verwijderen |
| PATCH | `/tasks/{id}/toggle` | Mark as done / openen |

## Oplevering Week 1

- [x] Model Task (title, description, is_done)
- [x] CRUD + validatie
- [x] Eerste lijstweergave
- [x] Mini-opdracht: "Mark as done" toggle

**Volgende stap (Week 2):** Breeze installeren, User → Tasks relatie, alleen eigen taken tonen.

---

*Laravel Todo App Traject — 8 weken — MBO Software Developer niveau 4*

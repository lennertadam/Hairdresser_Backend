# Backend Dokumentáció

## Táblák

## Végpontok

|Tábla|CRUD|Végpont|Leírás|Jogkör|
|-----|----|-------|------|------|
|UserController|-|-|-|-|
|Users|GET|/user|Összes felhasználó lekérése|Admin|
|Users|GET|/barber|Összes borbély lekérése|Admin|
|Users|POST|/login|Bejelentkezés|Felhasználó|
|Users|POST|/register|Regisztáció|Felhasználó|
|Users|POST|/logout|Kijelentkezés|Felhasználó|
|AdminController|-|-|-|-|
|Users|PUT|/revokeRole/{id}|Jogkör megvonása, felhasználó jogkörig|Admin|
|Users|PUT|/giveAdmin/{id}|Admin jogkör beállítása|Superadmin|
|Users|PUT|/giveBarber/{id}|Borbély jogkör beállítása|Admin|
|Users|PUT|/giveInactive/{id}|Inaktív jogkör beállítása|Admin|
|ServiceController|-|-|-|-|
|Services|GET|/service|Összes szolgáltatás lekérése|Felhasználó|
|Services|GET|/service/{id}|Egy szolgáltatás lekérése id alapján|Felhasználó|
|Services|POST|/service|Új szolgáltatás létrehozása|Felhasználó|
|Services|PUT|/service/{id}|Szolgáltatás változtatása id alapján|Felhasználó|
|Services|DELETE|/service/{id}|Szolgáltatás törlése id alapján|Felhasználó|
|ReservationController|-|-|-|-|
|Reservations|GET|/reservation|Összes foglalás lekérése|Felhasználó|
|Reservations|GET|/reservation/{id}|Foglalás lekérése id alapján|Felhasználó|
|Reservations|GET|/activeReservation|Összes aktív foglalás lekérése|Felhasználó|
|Reservations|GET|/barberReservation/{barber_id}|Egy borbély foglalásainak lekérése|Felhasználó|
|Reservations|GET|/customerReservation/{customer_id}|Egy vevő foglalásainak lekérése|Felhasználó|
|Reservations|GET|/barberActiveReservation/{barber_id}|Egy borbély aktív foglalásainak lekérése|Felhasználó|
|Reservations|GET|/upcomingReservation|Összes jövőbeli foglalás lekérése|Felhasználó|
|Reservations|GET|/completeReservation|Összes kész foglalás lekérése|Felhasználó|
|Reservations|POST|/reservation|Új foglalás létrehozása|Felhasználó|
|Reservations|PUT|/reservation/{id}|Foglalás változatása id alapján|Admin|
|Reservations|PUT|/completeReservation/{id}|Foglalás készként jelölése id alapján|Admin|
|Reservations|PUT|/cancelReservation/{id}|Foglalás lemondásának jelölése id alapján|Admin|
|Reservations|PUT|/invalidReservation/{id}|Foglalás érvénytelennek jelölése id alapján|Admin|
|Reservations|DELETE|/reservation/{id}|Foglalás törlése id alapján|Superadmin|
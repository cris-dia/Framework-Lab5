# Framework-Lab5

### **1. Soluții integrate pentru autentificare oferite de Laravel**
Laravel oferă mai multe soluții integrate pentru a gestiona autentificarea utilizatorilor:

#### **a. Laravel Breeze**
- Simplă și minimală, bazată pe Blade și Tailwind CSS.
- Include autentificare, înregistrare, resetarea parolei, verificarea email-ului.
- Potrivit pentru aplicații mici sau medii.

#### **b. Laravel Fortify**
- Backend-only, fără front-end inclus.
- Oferă funcționalități extinse precum autentificare cu doi factori (2FA) și verificarea email-ului.
- Este configurabil și extensibil.

#### **c. Laravel Jetstream**
- Include funcționalități avansate bazate pe Laravel Fortify, împreună cu echipe și API management.
- Suport pentru Blade sau Inertia.js.
- Potrivit pentru aplicații complexe.

#### **d. Sanctum**
- Oferă autentificare bazată pe token-uri pentru aplicații SPA (Single Page Applications) sau API-uri.

#### **e. Passport**
- Utilizat pentru implementarea autentificării OAuth2.
- Potrivit pentru aplicații care necesită autentificare avansată pentru API-uri.

---

### **2. Metode de autentificare a utilizatorilor**

#### **a. Bazate pe sesiune**
- Utilizatorii se autentifică folosind email și parolă.
- Datele sesiunii sunt stocate pe server, iar clientul primește un cookie.

#### **b. Bazate pe token-uri**
- Utilizatorul primește un token după autentificare (JWT, Sanctum, Passport).
- Utilizat mai ales pentru API-uri și aplicații fără state.

#### **c. Autentificare cu doi factori (2FA)**
- Adaugă un nivel suplimentar de securitate printr-un cod generat temporar sau trimis pe email.

#### **d. Autentificare socială**
- Folosind platforme precum Google, Facebook, GitHub.
- Implementat cu pachete precum Laravel Socialite.

#### **e. Autentificare cu link magic**
- Se trimite un link unic pe email pentru autentificare, fără a necesita parolă.

#### **f. Autentificare cu LDAP**
- Integrarea autentificării utilizatorilor într-un sistem LDAP (ex. Active Directory).

---

### **3. Diferența dintre autentificare și autorizare**

#### **Autentificare**
- Procesul de verificare a identității unui utilizator.
- Asigură că utilizatorul este cine pretinde că este (ex.: verificare email și parolă).
- Exemplu în Laravel: `Auth::attempt()`.

#### **Autorizare**
- Procesul de verificare a drepturilor de acces ale unui utilizator pentru anumite resurse sau acțiuni.
- Determină ce poate face un utilizator după ce este autentificat.
- Exemple în Laravel:
  - Middleware: `auth`, `can`.
  - Gates și Policies: `Gate::allows()`, `Policy`.

---

### **4. Protecția împotriva atacurilor CSRF în Laravel**

#### **Cum funcționează CSRF?**
Un atac CSRF (Cross-Site Request Forgery) permite unui atacator să trimită cereri în numele unui utilizator autentificat fără știrea acestuia.

#### **Protecția în Laravel**
Laravel oferă protecție implicită împotriva atacurilor CSRF prin intermediul middleware-ului `VerifyCsrfToken`.

#### **Mecanismul de protecție**
- Laravel include un **token CSRF** unic pentru fiecare sesiune de utilizator.
- Acest token trebuie să fie prezent în fiecare cerere POST, PUT, DELETE și PATCH.
- Tokenul este verificat automat de middleware.


### **Concluzie**
Laravel oferă soluții robuste pentru autentificare și autorizare, cu protecție integrată împotriva atacurilor CSRF, fiind potrivit pentru o gamă largă de aplicații, de la SPA-uri la aplicații complexe cu API-uri.

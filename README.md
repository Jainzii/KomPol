# KomPol
Website für E-Partizipation in der Kommunalpolitik im Rahmen eines Webprogrammierung Moduls

Hinweise:
- Die in der Planung dargestellten, markierten Politiker sind die in der Kommune gewählten Vertreter (Über das Thema regulärer Parteiangehöriger stimmen wir uns noch im Team ab)
- Das responsive Design wurde mit den Entwicklertools von Chrome getestet
- Die Registrierung soll über die Kommune ablaufen und vom Bürger ergänzt werden. Dafür sind drei angefertigte Accounts mit den Registrierungscodes: "n3v4m1nd" und "hbf123" angelegt. E-Mail sowie Passwort können frei gewählt werden. 
- Alternativ besteht aktuell auch die Möglichkeit, sich ohne Registrierungscode zu registrieren. (Für Test und Vorschauzwecke)
- Angemeldete Accounts: 
  - Email: mux@masterman.de Passwort: hallo12 
  - Email: haley@hinkelbottom.com Passwort: Pelikan
  - Email: klarissa@schmied.de Passwort: Amsel
- Die FileDAOs werden zwar nicht mehr genutzt, sind aber trotzdem für die Vollständigkeit noch im Projekt

Anmekungen:
- Es bestehen nach wie vor noch einige technische Schulden
- Unsere JavaScript-Features sind:
  - Drag-And-Drop für das Hochladen vom Profilbild
  - Ein Countdown auf der Kommunalpolitik-Seite zur nächsten Wahl
  - Eine Live-Eingabe-Validierung für die Registrierung
  - Eine Benutzernamen-Validierung, welche mit der AJAX-Technologie implementiert wurde. Benutzernamen haben in unsererem Projekt aktuelle keine Verwendung, könnten aber bspw. für anonyme Beiträge verwendet werden.
- Bei dem Feature zum Teilen von Beiträgen auf Facebook benutzen wir eine richtige URL (https://www.neuDorias.de/...), da Facebook sonstige Links (zumindest localhost) für das Teilen nicht akzeptiert.


Für das Testen der Benutzernamen-Validierung: Existierende Nutzernamen: derde, maxmu, tester
  

# Studio Link Integration für WordPress

Das Entwicklungsziel dieses Plugins ist es, jedem zu ermöglichen, seinen Studio Link Live Podcast einfach in WordPress einzubinden und je nach Status des Livestreams Veränderungen an der Seite vorzunehmen.
Das mit dem Ziel, es zu ermöglichen, den Benutzer auf der Seite auf eine selbst festgelegte Methode zu vermitteln, dass der Livestream gerade sendet oder eben nicht.

So ist zum Beispiel denkbar, eine Box einzublenden, wenn der Podcast live ist und so die Benutzer darauf hinweist.
Eine andere Möglichkeit ist es, eine OnAir Grafik im Hintergrund einzublenden oder gleich den Live Podcast in einer Leiste einzubinden.

Aber auch darüber hinaus gibt es Pläne: So arbeiten wir derzeit an einer Anbindung an den Podlove Publisher und an einem Twitter Post Bot, der deine Follower informiert, wenn dein Podcast online geht.

Vorerst gibt es aber folgende Funktionalität:

**[StudioLink status="Preshow"]**
Dieser Text wird nur angezeigt, wenn die Show in der Preshow ist.
**[/StudioLink]**

**[StudioLink status="Live"]**
Jetzt sind wir sogar Live!
**[/StudioLink]**

**[StudioLink online="true"]**
Dieser Text wird angezeigt, wenn der Podcast in der Preshow, Live oder in der Postshow ist.
**[/StudioLink]**

**[StudioLink]**
Das hat genau den gleichen Effekt wie online="true".
**[/StudioLink]**

Es gibt folgende Zustände:

**Online:** true / false

**Status:** offline / preshow / live / postshow / break / online


Für das Erkennen des Status wird der Podcast genutzt, der in den Einstellungen festgelegt werden kann.
Soll der Status eines anderen Podcasts genutzt werden, gibt es auch die Möglichkeit für jedes Shortcode einen eigenen Podcast festzulegen:

**[StudioLink online="true" slug="podcastastisch"]**
Dieser Text wird angezeigt, wenn der Podcast "podcastastisch" in der Preshow, Live oder in der Postshow ist.
**[/StudioLink]**


### Installation

1. Lade das Plugin über den Grünen Button oben rechts "Clone or Download" und dann "Download ZIP" herunter.
2. Gehe in Wordpress auf die Plugin Installation und dort auf "Plugin Hochladen".
3. Lade das Plugin hoch, Installiere und Aktiviere es.

### Known Bugs
= 1.0.1 =
Die Übersetzung funktioniert nicht.

### Changelog
= 1.0.1 =
Admin Menu neu Strukturiert, beginn der Implementierung von Twitter Auto Posts

= 1.0 =
Die erste Version: Es gibt Shortcodes.

### Warum sollte ich Updaten?

= 1.0.1 =
Das neue Menu ist deutlich Benutzerfreundlicher, es gibt nun die Möglichkeit, Shortcodes zu deaktivieren und man kann sich schon auf die Menu Struktur der Twitter Posts vorbereiten.

= 1.0 =
Naja - Du hast nicht wirklich eine Wahl oder?

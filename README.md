## Deutsch:

# Studio Link Integration für WordPress

Das Entwicklungsziel dieses Plugins ist es, jedem zu ermöglichen seinen Studio Link Live Podcast einfach in Wordpress ein zu binden und je nach Status des Livestreams Veränderungen an der Seite vorzunehmen.
Das mit dem Ziel, es zu ermöglichen den Benutzer auf der Seite auf eine selbst festgelegte Methode zu vermitteln, dass der Livestream gerade sendet oder eben nicht.

So ist zum Beispiel denkbar, eine Box ein zu blenden wenn der Podcast live ist, die Benutzer darauf hinweist.
Eine andere Möglichkeit ist es, eine OnAir Grafik im Hintergrund einzublenden oder gleich den Live Podcast in einer Leiste einzubinden.

Aber auch darüber hinaus gibt es pläne: So arbeiten wir derzeit an einer anbindung an den Podlove Publisher und an einem Twitter Post Bot, der deine Follower informiert, wenn dein Podcast Online geht.

Vorerst gibt es aber folgende Funktionalität:

**[StudiLink status="Preshow"]**
Dieser Text wird nur angezeigt, wenn die Show in der Preshow ist.
**[/StudioLink]**

**[StudiLink status="Live"]**
Jetzt sind wir sogar Live!
**[/StudioLink]**

**[StudiLink online="true"]**
Dieser Text wird angezeigt, wenn der Podcast in der Preshow, Live oder in der Postshow ist.
**[/StudioLink]**

**[StudiLink]**
Das hat genau den gleichen effekt wie online="true".
**[/StudioLink]**

Für das erkennen des Status wird der Podcast genutzt, der in den Einstellungen festgelegt werden kann.
Soll der Status eines anderen Podcasts genutzt werden, gibt es auch die Möglichkeit für jedes Shortcode einen eigenen Podcast fest zu legen:

**[StudiLink online="true" slug="podcastastisch"]**
Dieser Text wird angezeigt, wenn der Podcast "podcastastisch" in der Preshow, Live oder in der Postshow ist.
**[/StudioLink]**


# Installation

1. Lade das Plugin über den Grünen Button oben rechts "Clone or Download" und dann "Download ZIP" herunter.
2. Gehe in Wordpress auf die Plugin Installation und dort auf "Plugin Hochladen".
3. Lade das Plugin hoch, Installiere und Aktiviere es.

# Known Bugs
= 1.0.1 =
Die Übersetzung funktioniert nicht.

# Changelog
= 1.0.1 =
Admin Menu neu Strukturiert, beginn der Implementierung von Twitter Auto Posts

= 1.0 =
Die erste Version: Es gibt Shortcodes.

# Warum sollte ich Updaten?

= 1.0.1 =
Das neue Menu ist deutlich Benutzerfreundlicher, es gibt nun die möglichkeit Shortcodes zu deaktivieren und man kann sich schon auf die Menu Strucktur der Twitter Posts vorbereiten.

= 1.0 =
Naja - Du hast nicht wirklich eine Wahl oder?
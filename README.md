# Covid-Zahlen

Team: </p>
Fabio Kaelin </p>
Christopher Scheel </p>
Denis Meyer

[Teamlogo](https://github.com/fchaelin/Covid-Zahlen/blob/main/Screenshot%202021-10-19%20101009.png)

Wir benutzen eine Covid API um globale Daten der Covidzahlen oder von den einzelnen Länder zu realisieren, so wie eine Darstellung dazu zu erstellen.
So dass man die Zahlen der erkrankten und gestorbenen mit den anderen Ländern vergleichen kann.

## API's

Als Covid API nutzen wir die [COVID2019 REST v1.0/V2.0](https://www.programmableweb.com/api/covid2019-rest-api-v10) </p>
Von dieser API holen wir die Daten bezüglich den Coronazahlen.

Als Länder API nutzen wir die [Länder v.1](https://api.first.org/v1/get-countries) </p>
Diese API nutzen wir um die Kürzel eines Landes in die Ausggeschriebene Variante zu bringen.

Als Flaggen API nutzen wir die [Flaggen der Länder](https://www.countryflags.io/) </p>
Diese API nutzen wir um die Flagge von den Ländern zu bekommen welche man abruft.


## Anwendung

Als erstes wird festgelegt, ob man die globalen- oder die Daten eines einzelnen Landes will, in dem die zugewiesene Zahl eingibt.


0 = Covidzahlen eines bestimmten Landes

1 = Covidzahlen der ganzen Welt

2 = Covidzahlen eines bestimmten Landes, an einem bestimmten Datum

3 = Covidzahlen der ganzen Welt, an einem bestimmten Datum


Gibt man die Zahl für ein bestimmtes Land ein (1), so muss man als nächstes angeben, über welches Land man informiert werden möchte.

Gibt man die Zahl für ein bestimmtes Land, an einem bestimmten Datum ein (2), so muss man als nächstes angeben, welches Land und von welchem Tag.

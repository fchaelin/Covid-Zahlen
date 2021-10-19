# Covid-Zahlen

Team: </p>
Fabio Kaelin </p>
Christopher Scheel </p>
Denis Meyer

[Teamlogo](https://github.com/fchaelin/Covid-Zahlen/blob/main/Screenshot%202021-10-19%20101009.png)

Wir benutzen eine Covid API und evtl. ein Diagramm API um globale Daten der Covidzahlen oder von den einzelnen Länder zu realisieren, so wie eine Darstellung dazu zu erstellen.
So dass man die Zahlen der erkrankten und gestorbenen mit den anderen Ländern vergleichen kann.

Als Covid API nutzen wir die [COVID2019 REST v1.0/V2.0](https://www.programmableweb.com/api/covid2019-rest-api-v10) </p>
Von dieser API holen wir die Daten bezüglich den Coronazahlen.

## Anwendung

Als erstes wird festgelegt, ob man die globalen- oder die Daten eines einzelnen Landes will, in dem die zugewiesene Zahl eingibt.

0 = Covidzahlen eines bestimmten Landes
1 = Covidzahlen der ganzen Welt
2 = Covidzahlen eines bestimmten Landes, an einem bestimmten Datum

Gibt man die Zahl für ein bestimmtes Land ein (1), so muss man als nächstes angeben, über welches Land man informiert werden möchte.

Gibt man die Zahl für ein bestimmtes Land, an einem bestimmten Datum ein (2), so muss man als nächstes angeben, welches Land und von welchem Tag.

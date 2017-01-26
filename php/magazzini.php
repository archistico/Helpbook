<?php

/*
SELECT movimentidettaglio.quantita, casaeditrice.casaeditrice, libri.titolo, movimenti.anno, movimentitipologia.codice, movimenti.numero, movimenti.movimentodata, movimentitipologia.movimentotipologia, movimenticausale.movimentocausale
FROM movimentidettaglio
INNER JOIN libri ON movimentidettaglio.fklibro = libri.idlibro
INNER JOIN libritipologia ON libri.fktipologia = libritipologia.idlibrotipologia
INNER JOIN movimenti ON movimenti.idmovimento = movimentidettaglio.fkmovimento
INNER JOIN movimentitipologia ON movimentitipologia.idmovimentotipologia = movimenti.fktipologia
INNER JOIN movimenticausale ON movimenti.fkcausale = movimenticausale.idmovimentocausale
INNER JOIN casaeditrice ON libri.fkcasaeditrice = casaeditrice.idcasaeditrice
WHERE movimenti.fksoggetto = 169 AND libritipologia.librotipologia = "Carta" AND (movimenticausale.movimentocausale = "Conto deposito" OR movimenticausale.movimentocausale = "Conto vendita") AND movimenti.chiuso = 0 AND movimenti.cancellato = 0
ORDER BY movimenti.movimentodata ASC, casaeditrice.casaeditrice ASC, libri.titolo ASC
*/

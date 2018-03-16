CREATE TABLE SEZIONE (
 Numero  SERIAL,
 Nome  VARCHAR(50) UNIQUE NOT NULL,
 Descrizione TEXT,

 PRIMARY KEY (Numero)
);

CREATE TABLE ARGOMENTO (
 Numero  SERIAL,
 Sezione  SERIAL,
 Nome  VARCHAR(60) UNIQUE NOT NULL,
 Descrizione TEXT,

 PRIMARY KEY (Numero, Sezione),
 FOREIGN KEY (Sezione) REFERENCES SEZIONE(Numero)
  ON DELETE NO ACTION
  ON UPDATE CASCADE
);

CREATE TABLE DEFINIZIONE (
 Codice  SERIAL,
 Nome  VARCHAR(50) UNIQUE NOT NULL,
 Testo  TEXT NOT NULL,
 Argomento SERIAL NOT NULL,
 Sezione  SERIAL NOT NULL,

 PRIMARY KEY (Codice),
 FOREIGN KEY (Argomento, Sezione) REFERENCES ARGOMENTO(Numero, Sezione)
  ON DELETE NO ACTION
  ON UPDATE CASCADE
);

CREATE TABLE DERIVA (
 Madre SERIAL,
 Figlia SERIAL,

 PRIMARY KEY (Madre, Figlia),
 FOREIGN KEY (Madre) REFERENCES DEFINIZIONE(Codice)
  ON DELETE NO ACTION
  ON UPDATE CASCADE,
 FOREIGN KEY (Figlia) REFERENCES DEFINIZIONE(Codice)
  ON DELETE NO ACTION
  ON UPDATE CASCADE
);

CREATE TYPE TipoTeorema AS ENUM('teorema', 'corollario', 'proposizione');

CREATE TABLE TEOREMA (
 Codice  SERIAL,
 Tipo  TipoTeorema DEFAULT 'teorema',
 Nome  VARCHAR(100) UNIQUE,
 Ipotesi  TEXT NOT NULL,
 Tesi  TEXT NOT NULL,
 Disegno  BYTEA,
 Argomento  SERIAL NOT NULL,
 Sezione  SERIAL NOT NULL,

 PRIMARY KEY (Codice),
 FOREIGN KEY (Argomento, Sezione) REFERENCES ARGOMENTO(Numero, Sezione)
   ON DELETE NO ACTION
   ON UPDATE CASCADE
);

CREATE TABLE IPOTESI (
 Teorema  SERIAL,
 Definizione SERIAL,

 PRIMARY KEY (Teorema, Definizione),
 FOREIGN KEY (Teorema) REFERENCES TEOREMA(Codice)
  ON DELETE NO ACTION
  ON UPDATE CASCADE,
 FOREIGN KEY (Definizione) REFERENCES DEFINIZIONE(Codice)
  ON DELETE NO ACTION
  ON UPDATE CASCADE
);

CREATE TABLE DIMOSTRAZIONE (
 Teorema SERIAL,
 Testo TEXT NOT NULL,
 Idea TEXT,

 PRIMARY KEY (Teorema),
 FOREIGN KEY (Teorema) REFERENCES TEOREMA(Codice)
  ON DELETE NO ACTION
  ON UPDATE CASCADE
);

CREATE TABLE RICHIAMA (
 Teorema   SERIAL,
 Dimostrazione SERIAL,

 PRIMARY KEY (Teorema, Dimostrazione),
 FOREIGN KEY (Teorema) REFERENCES TEOREMA(Codice)
  ON DELETE NO ACTION
  ON UPDATE CASCADE,
 FOREIGN KEY (Dimostrazione) REFERENCES DIMOSTRAZIONE(Teorema)
  ON DELETE NO ACTION
  ON UPDATE CASCADE
);

CREATE TABLE ESEMPIO (
 Numero  SERIAL,
 Teorema  SERIAL,
 Testo  TEXT NOT NULL,
 Disegno  BYTEA,
 Difficolta INT,

 PRIMARY KEY (Numero, Teorema),
 FOREIGN KEY (Teorema) REFERENCES TEOREMA(Codice)
  ON DELETE NO ACTION
  ON UPDATE CASCADE,
 CHECK (Difficolta >= 1 AND Difficolta <= 5)
);
<?php

// Error class
Class Error {

    private $class;
    private $error;

    // Error messages
    private $errormessages = array(
        "Error" => array(
            "noclass" => "Virheellinen virhe! Tuntematon luokka!",
            "nomessage" => "Virheellinen virhe! Tuntematon virhe!"
        ),
        "Post" => array(
            "requestmethod" => "Virheellinen pyyntö!",
            "notset" => "Tarvittavaa parametria ei annettu!",
            "novalue" => "Parametrilla ei ole arvoa!"
        ),
        "Check" => array(
            "wrongtype" => "Parametrin arvo on väärää muotoa!",
            "toolong" => "Parametrin arvo on liian pitkä!",
            "tooshort" => "Parametrin arvo on liian lyhyt!",
            "toolarge" => "Parametrin arvo on liian suuri!",
            "toosmall" => "Parametrin arvo on liian pieni!"
        ),
        "Database" => array(
            "connection" => "Yhteyttä tietokantapalvelimeen ei voitu muodostaa!",
            "execution" => "Toimintoa ei voitu suorittaa tietokantavirheen vuoksi!"
        ),
        "Ajax" => array(
            "invalid" => "Virheellinen pyyntö!"
        ),
        "Cookies" => array(
            "notset" => "Virheelliset evästeet!",
            "novalue" => "Virheellinen evästeen arvo!"
        )

    );

    // Error construction
    public function __construct($object, $error) {
        // Get error parameters
        $this->class = get_class($object);
        $this->error = $error;

        // Handle error
        $this->handleError();
    }

    // Error handler
    private function handleError() {
        // Check if class exists
        if (!array_key_exists($this->class, $this->errormessages)) {
            new Error($this, "noclass");
        }

        // Check if error message exists
        if (!array_key_exists($this->error, $this->errormessages[$this->class])) {
            new Error($this, "nomessage");
        }

        // Print error
        $message = $this->errormessages[$this->class][$this->error];
        new Json($message, false);
    }
}

?>

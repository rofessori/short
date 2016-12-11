<?php

// Json class
Class Json {

    // Construct json
    public function __construct($payload, $success) {
        // Globals
        global $post;

        $data = array(
            "success" => $success,
            "payload" => $payload
        );

        // If ajax request
        if ($post->ajaxParams) {
            // Print ajax data
            $this->printJSON($data);
        }
        else {
            if ($success) {
                // Print HTML page
                $this->printPlainHTML($payload);
            }
            else {
                // Print HTML error page
                $this->printErrorHTML($payload);
            }
        }

        // Exit program
        exit;
    }

    private function printJSON($data) {
        echo json_encode($data);
    }

    private function printPlainHTML($data) {
        echo $data;
    }

    private function printErrorHTML($data) {
        echo "<h1>Voi koira!</h1>";
        echo "<h3>Tapahtui seuraava virhe:</h3>";
        echo "<pre>" . $data . "</pre>";
    }
}

?>

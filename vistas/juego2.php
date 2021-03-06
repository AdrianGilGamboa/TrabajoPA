<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>CodePen - CSS Hangman using :checked [CPC]</title>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Permanent+Marker&amp;display=swap'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css'><link rel="stylesheet" href="./juego2.css">

    </head>
    <body>
        <?php
        if (isset($_POST['jugarahorcado'])) {
            if ($_POST['tipo'] === "silver" || $_POST['tipo'] === "gold") {
                $nombreUsuario = $_POST['nombre'];
            } else {
                header('Location: cuenta.php');
            }
        } else {
            header('Location: cuenta.php');
        }
        ?>
        <h1>Hello <?php echo $nombreUsuario;?>, this is Three in a row!
        </h1><br/>
        <!-- partial:index.partial.html -->
        <!--Scroll down and cheat, if you don't want to cheat and want a different word - change the value of reset and a new word will be generated (not based on reset)-->
        <br/><input type="radio" letter="A"/>
        <input type="radio" letter="B"/>
        <input type="radio" letter="C" correct="correct"/>
        <input type="radio" letter="D"/>
        <input type="radio" letter="E" correct="correct"/>
        <input type="radio" letter="F"/>
        <input type="radio" letter="G"/>
        <input type="radio" letter="H"/>
        <input type="radio" letter="I"/>
        <input type="radio" letter="J"/>
        <input type="radio" letter="K"/>
        <input type="radio" letter="L"/>
        <input type="radio" letter="M"/>
        <input type="radio" letter="N"/>
        <input type="radio" letter="O" correct="correct"/>
        <input type="radio" letter="P"/>
        <input type="radio" letter="Q"/>
        <input type="radio" letter="R" correct="correct"/>
        <input type="radio" letter="S" correct="correct"/>
        <input type="radio" letter="T"/>
        <input type="radio" letter="U" correct="correct"/>
        <input type="radio" letter="V"/>
        <input type="radio" letter="W"/>
        <input type="radio" letter="X"/>
        <input type="radio" letter="Y"/>
        <input type="radio" letter="Z"/>
        <div class="break"></div>
        <svg class="hangman" viewBox="0 0 96 96">
        <line class="stage10" x1="62" y1="70" x2="56" y2="56"></line>
        <line class="stage9" x1="50" y1="70" x2="56" y2="56"></line>
        <line class="stage8" x1="68" y1="46" x2="56" y2="40"></line>
        <line class="stage7" x1="44" y1="46" x2="56" y2="40"></line>
        <line class="stage6" x1="56" y1="40" x2="56" y2="56"></line>
        <circle class="stage5" cx="56" cy="34" r="6"></circle>
        <line class="stage4" x1="56" y1="16" x2="56" y2="28"></line>
        <line class="stage3" x1="24" y1="24" x2="32" y2="16"></line>
        <line class="stage3" x1="21" y1="16" x2="60" y2="16"></line>
        <line class="stage2" x1="24" y1="80" x2="24" y2="16"></line>
        <line class="stage1" x1="16" y1="80" x2="32" y2="80"></line>
        </svg>
        <div class="break"></div>
        <div class="hint">
            <div class="letter" value="S"></div>
            <div class="letter" value="O"></div>
            <div class="letter" value="U"></div>
            <div class="letter" value="R"></div>
            <div class="letter" value="C"></div>
            <div class="letter" value="E"></div>
        </div>
        <div class="hangman">
            <div class="lose stage10">
                <div>
                    <div class="top">Commiserations</div>
                    <div class="bottom">Word was source</div>
                </div>
            </div>
        </div>
        <div class="wincondition">
            <div class="letter" value="S">
                <div class="letter" value="O">
                    <div class="letter" value="U">
                        <div class="letter" value="R">
                            <div class="letter" value="C">
                                <div class="letter" value="E">
                                    <div class="win">Congratulations</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial -->
        <script src='https://codepen.io/z-/pen/a8e37caf2a04602ea5815e5acedab458.js'></script>
    </body>
</html>

export class Menu {
    constructor(scene) {
        this.scene = scene;
        this.isVisible = false;
        this.buttons = [];
        this.createMenu();
    }
    //CHATGPT: Ayudame a gestionar un menú que me permita desde la partida tocarlo y pueda salir ( terminar juego) volver al primer nivel , reiniciar la partida (en la misma escena), toma de referencia este codigo (base del metodo pegado a chat)
    createMenu() {
        // Fondo del menú
        this.background = this.scene.add.image(0, 0, 'menu')
            .setDepth(20)
            .setVisible(false)
            .setScale(0.8);

       
        this.createImageButton('restart', 0, -60, () => this.restartGame());
        this.createImageButton('level1', 0, 0, () => this.goToFirstLevel());
        this.createImageButton('exit', 0, 60, () => this.quitGame());

   
        this.scene.input.keyboard.on('keydown-E', () => {
            this.toggleMenu();
        });
    }

    createImageButton(imageKey, offsetX, offsetY, callback) {
        const button = this.scene.add.image(0, 0, imageKey)
            .setInteractive()
            .setDepth(21)
            .setVisible(false)
            .setScale(0.6); 

        button.on('pointerdown', callback);
        button.on('pointerover', () => button.setTint(0xffff66));
        button.on('pointerout', () => button.clearTint());

        this.buttons.push({ button, offsetX, offsetY });
    }

    toggleMenu() {
        this.isVisible = !this.isVisible;
        this.background.setVisible(this.isVisible);

        if (this.isVisible) {
            this.positionMenu();
            this.scene.physics.pause();
        } else {
            this.scene.physics.resume();
        }

    
        this.buttons.forEach(({ button }) => {
            button.setVisible(this.isVisible);
        });
    }

    positionMenu() {
        const cam = this.scene.cameras.main;

      
        this.background.setPosition(cam.midPoint.x, cam.midPoint.y);

       
        this.buttons.forEach(({ button, offsetX, offsetY }) => {
            button.setPosition(cam.midPoint.x + offsetX, cam.midPoint.y + offsetY);
        });
    }

    restartGame() {
        this.scene.scene.restart();
    }

    goToFirstLevel() {
        this.scene.scene.start('game');
    }

    quitGame() {
      
        window.location.href = "http://gameplatform.test/Juego_MrNuts/index.html";
        //window.history.back(); 
        console.log("Quit Game");
        this.scene.game.destroy(true);
    }
}
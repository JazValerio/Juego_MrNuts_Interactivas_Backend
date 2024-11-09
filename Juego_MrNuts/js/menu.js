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

        // Botones con imágenes
        this.createImageButton('restart', 0, -60, () => this.restartGame());
        this.createImageButton('level1', 0, 0, () => this.goToFirstLevel());
        this.createImageButton('exit', 0, 60, () => this.quitGame());

        // Tecla para abrir/cerrar el menú
        this.scene.input.keyboard.on('keydown-E', () => {
            this.toggleMenu();
        });
    }

    createImageButton(imageKey, offsetX, offsetY, callback) {
        const button = this.scene.add.image(0, 0, imageKey)
            .setInteractive()
            .setDepth(21)
            .setVisible(false)
            .setScale(0.6); // Ajusta el tamaño si es necesario

        button.on('pointerdown', callback);
        button.on('pointerover', () => button.setTint(0xffff66)); // Efecto al pasar el ratón por encima
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

        // Mostrar u ocultar los botones
        this.buttons.forEach(({ button }) => {
            button.setVisible(this.isVisible);
        });
    }

    positionMenu() {
        const cam = this.scene.cameras.main;

        // Centra el fondo del menú
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
        this.scene.game.destroy(true);
    }
}
export class WinScreen {
    constructor(scene) {
        this.scene = scene;
        this.visible = false; // Propiedad para controlar la visibilidad manualmente

        this.createScreen();
        this.hide(); // Ocultar la pantalla al inicio
    }

    createScreen() {
        const cam = this.scene.cameras.main;

        // Imagen de fondo de la pantalla de "Ganaste"
        this.winScreenImage = this.scene.add.image(cam.width / 2, cam.height / 2, 'winScreen').setOrigin(0.5).setDepth(10). setScale(0.8);

        
        this.nextLevelButton = this.scene.add.image(cam.width / 2, cam.height / 2 , 'continue')
            .setOrigin(0.5)
            .setScale(0.6)
            .setInteractive()
            .setDepth(10)
            .on('pointerdown', () => {
                if(this.scene.currentLevel === 1) {
                    this.scene.cameras.main.fade(1000);
                    this.scene.cameras.main.on('camerafadeoutcomplete', function (camera, effect) {
                        this.scene.scene.start('game2', { score: this.scene.score }); 
                    }, this);
                }
                else if(this.scene.currentLevel === 2) {
                    this.scene.cameras.main.fade(1000);
                    this.scene.cameras.main.on('camerafadeoutcomplete', function (camera, effect) {
                        this.scene.scene.start('game3', { score: this.scene.score }); 
                    }, this);
                }
            });

        
        this.exitButton = this.scene.add.image(cam.width / 2, cam.height / 2 + 50, 'exit')
            .setOrigin(0.5)
            .setScale(0.6)
            .setInteractive()
            .setDepth(10)
            .on('pointerdown', () => {
                window.location.href = "http://gameplatform.test/Juego_MrNuts/index.html";
                this.scene.game.destroy(true);
            });
    }

    show() {
        // Posicionar todos los elementos en función de la cámara, útil para zoom y movimiento
        const cam = this.scene.cameras.main;
        this.winScreenImage.setPosition(cam.scrollX + cam.width / 2, cam.scrollY + cam.height / 2);
        this.nextLevelButton.setPosition(cam.scrollX + cam.width / 2, cam.scrollY + cam.height / 2 + 100);
        this.exitButton.setPosition(cam.scrollX + cam.width / 2, cam.scrollY + cam.height / 2 + 160);
        
        // Hacer visibles los elementos
        this.winScreenImage.setVisible(true);
        this.nextLevelButton.setVisible(true);
        this.exitButton.setVisible(true);
        this.visible = true;
    }

    hide() {
        // Ocultar los elementos de la pantalla de victoria
        this.winScreenImage.setVisible(false);
        this.nextLevelButton.setVisible(false);
        this.exitButton.setVisible(false);
        this.visible = false;
    }
}
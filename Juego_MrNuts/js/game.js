import { Platform } from './components/platform.js';
import { Player } from './components/player.js';
import { loader } from './loader.js';
import { Enemy } from './components/enemy.js';
import { Collecters } from './components/collecters.js';
import { Inventory } from './inventory.js';
import { Menu } from './menu.js';
import { WinScreen } from './winScreen.js';

export class Game extends Phaser.Scene {

    constructor() {
        super({ key: 'game' });
        this.score = 0;
        this.currentLevel = 1;

        this.timer;
        this.lengthe;
        this.hasFetched=false;

        window.gameInstance = this;
    
    }

    init(data) {
        this.lengthe =0;
        this.hasFetched=false;
    }

    preload() {
        //link de joystick
        let url = 'https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/dist/rexvirtualjoystickplugin.min.js';
        this.load.plugin('rexvirtualjoystickplugin', url, true);
        loader(this);
        //this.load.json('levelData', './data/levelData.json');
        this.load.json('levelData', 'http://gameplatform.test/editor/api.php?id=1');
        this.inventory = new Inventory(this);
    }

    create() {
        const levelData = this.cache.json.get('levelData');
        this.add.image(0, 0, 'background').setOrigin(0, 0).setScale(1);
        this.plataform = new Platform(this, levelData);
        
        this.collecters = new Collecters(this, levelData);
        this.plataform.create();    
        this.collecters.create();
        //se crea el joystick y se envía al player
        this.create_joystick();
        this.player = new Player(this, this.joystick);
        this.enemy = new Enemy(this, levelData, this.player);
        this.enemy.create();
        this.player.create();
        this.inventory.create();
        this.create_colliders();
        this.menu = new Menu(this);

        this.timer = this.time.addEvent({
            delay: 1000,
            loop: true,
            callbackScope: this,
            callback: this.startTraking
            
        });

        this.scoreText = this.add.text(280, 170, 'Score: ' + this.score, { fontSize: '20px', fill: '#fff' }).setScrollFactor(0);

        this.winScreen = new WinScreen(this);
    }

    update() {
        this.player.update();
        this.enemy.update();
        console.log(this.collecters.getRemainingCount());

        if (this.collecters.getRemainingCount() === 0) {
           
            this.winScreen.show();

        }

        this.input.on('pointerdown', function (pointer) {
            console.log("🦐" + pointer.x, pointer.y);
        });
    }

    create_colliders() {
        this.physics.add.collider(this.player.get(), this.plataform.get(), null,/*evistar la colisión con la cabeza del player*/(player) => {
            if (player.body.velocity.y < 0) return false;
            return true;
        });

        this.physics.add.overlap(this.player.get(), this.plataform.getEnergyBalls(), (player, energyBall) => {
            this.updateScore(-50); 
            this.player.playerSlowDown();
            energyBall.destroy();
        }, null);

        this.physics.add.overlap(this.player.get(), this.collecters.getPowerCollectors(), (player, power) => {
            this.updateScore(100); 
            this.player.playerSpeedBoost();
            this.inventory.addItem('power');
            power.destroy();
            this.collecters.updateRemainingCount();
        }, null);

        this.physics.add.overlap(this.player.get(), this.collecters.getFixBoxCollectors(), (player, fixBox) => {
            this.updateScore(200);
            this.inventory.addItem('fixBox');
            fixBox.destroy();
            this.collecters.updateRemainingCount();
        }, null);

        this.physics.add.overlap(this.player.get(), this.enemy.getEnemies(), (player, enemies) => {
            this.updateScore(-1);
            this.player.damageSpeed(220);
        }, null);
    }

    create_joystick() {
        this.joystick = this.plugins.get('rexvirtualjoystickplugin').add(this, {
            x: 840,
            y: 440,
            radius: 500,
            base: this.add.circle(0, 0, 60, 0x888888).setAlpha(0.5),
            thumb: this.add.circle(0, 0, 40, 0xcccccc).setAlpha(0.5),
        });
    }

    updateScore(score) {
        this.score += score;
        this.scoreText.setText('Score: ' + this.score); 
    }


    startTraking() {
        this.lengthe += 1;
        console.log(this.lengthe,this.currentLevel);
    }

    restartGame(){
        this.cameras.main.fade(1000);
            this.cameras.main.on('camerafadeoutcomplete', function (camera, effect) {
                //restart game
                this.scene.restart();
                this.score = 0;

                if(!this.hasFetched){
                    this.hasFetched = true;
                    this.saveData("No", this.currentLevel);
                }

            }, this)
    }

    saveData(hasClosed, level){
        fetch('http://gameplatform.test/tracking.php', {
            method: 'POST',
            mode: 'same-origin',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "browser": navigator.userAgent,
                "screen": screen.width + "x" + screen.height,
                "length": this.lengthe,
                "level": level,
                "closed": hasClosed,
                "score": this.score
            }),
            keepalive: true
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        });
    }

 
};

//chatgpt: Ayudame basandote en este código (base del código) a que se pueda acceder a el método saveData ya que en este contexto de this no se encuentra

window.addEventListener('beforeunload', (e) => {
    console.log("Browser tab is being closed");
    if (window.gameInstance) {
        window.gameInstance.saveData("Yes", window.gameInstance.currentLevel);
    }
});


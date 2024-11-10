import { Platform } from './components/platform.js';
import { Player } from './components/player.js';
import { loader } from './loader.js';
import { Enemy } from './components/enemy.js';
import { Collecters } from './components/collecters.js';
import { Inventory } from './inventory.js';
import { Menu } from './menu.js';
export class Game extends Phaser.Scene {

    constructor() {
        super({ key: 'game' });
    }

    init() {
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
    }

    update() {
        this.player.update();
        this.enemy.update();
        console.log(this.collecters.getRemainingCount());

        if (this.collecters.getRemainingCount() === 0) {
            this.cameras.main.fade(1000);
            this.cameras.main.on('camerafadeoutcomplete', function (camera, effect) {
                this.scene.start('game2'); // Cambia a la siguiente escena
            }, this)
            
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
            this.player.playerSlowDown();
            energyBall.destroy();
        }, null);

        this.physics.add.overlap(this.player.get(), this.collecters.getPowerCollectors(), (player, power) => {
            this.player.playerSpeedBoost();
            this.inventory.addItem('power');
            power.destroy();
            this.collecters.updateRemainingCount();
        }, null);

        this.physics.add.overlap(this.player.get(), this.collecters.getFixBoxCollectors(), (player, fixBox) => {
            this.inventory.addItem('fixBox');
            fixBox.destroy();
            this.collecters.updateRemainingCount();
        }, null);
    }

    create_joystick() {
        this.joystick = this.plugins.get('rexvirtualjoystickplugin').add(this, {
            x: 230,
            y: 500,
            radius: 500,
            base: this.add.circle(0, 0, 60, 0x888888).setAlpha(0.5),
            thumb: this.add.circle(0, 0, 40, 0xcccccc).setAlpha(0.5),
        });
    }
};

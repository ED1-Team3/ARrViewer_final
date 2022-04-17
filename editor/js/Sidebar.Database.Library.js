// New JS File

//import { UIPanel, UIText, UIRow } from './libs/ui.js'; 
/*import { UIBoolean } from './libs/ui.three.js';*/
import { UIPanel, UIText, UIRow, UIInput, UIHorizontalRule } from './libs/ui.js';
import * as THREE from '../../build/three.module.js';
import { AddObjectCommand } from './commands/AddObjectCommand.js';
import { GLTFLoader } from '../../examples/jsm/loaders/GLTFLoader.js';
import { DRACOLoader } from '../../examples/jsm/loaders/DRACOLoader.js';
import { zipSync, strToU8 } from '../../examples/jsm/libs/fflate.module.js';
import { SetSceneCommand } from './commands/SetSceneCommand.js';

import { LoaderUtils } from './LoaderUtils.js';

function SidebarDatabaseLibrary( editor ) {

	var signals = editor.signals;
	var strings = editor.strings;

	var container = new UIPanel();
    
    var libraryRow = new UIRow();
    libraryRow.add( new UIText( strings.getKey( 'sidebar/database/library' ).toUpperCase() ) );
    container.add( libraryRow );

    //add function that will link to model library
    //var option = ['shiba','fish','dinosaur','desk','house','statue','sculpture'];
    var items = [
		{ title: 'models/wasp.png', file: 'models/wasp/', cate: 'Animal' },
		{ title: 'models/skull.png', file: 'models/skull/', cate: 'Sculpture' },
        { title: 'models/car.png', file: 'models/car/', cate: 'Vehicle' },
        { title: 'models/squid.png', file: 'models/squid/', cate: 'Characters' },
        { title: 'models/drone.png', file: 'models/drone/', cate: 'Technology' }

	];

    for ( var i = 0; i < items.length; i ++ ) {

		( function ( i ) {
            
            

			var item = items[ i ];

			var option = new UIRow();
            option.add( new UIText( item.cate ));

            var edittextIcon1 = document.createElement( 'img' );
            edittextIcon1.src = item.title;
            option.dom.appendChild( edittextIcon1 );

			option.onClick( function () {
                
                const loader = new GLTFLoader().setPath( item.file );
                loader.load(
                    // resource URL
                    //'scene.gltf',
                    'scene.gltf',
                
                    // onLoad callback
                    function ( data ) {
                        // output the text to the console
                        //console.log( data )
                        editor.execute( new AddObjectCommand( editor, data.scene) );
                    },
                );
				

				

			} );
			container.add(option);

		} )( i );

	}

    return container;
}

export {SidebarDatabaseLibrary};
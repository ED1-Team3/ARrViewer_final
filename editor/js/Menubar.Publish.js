//import * as THREE from 'three';
import * as THREE from '../../build/three.module.js';
import { zipSync, strToU8 } from '../../examples/jsm/libs/fflate.module.js';
import { UIPanel, UIRow, UIHorizontalRule } from './libs/ui.js';

function MenubarPublish( editor ) {

	const strings = editor.strings;

	const container = new UIPanel();
	container.setClass( 'menu' );

	const title = new UIPanel();
	title.setClass( 'title' );
	title.setTextContent( strings.getKey( 'menubar/publish' ) );
	container.add( title );

	const options = new UIPanel();
	options.setClass( 'options' );
	container.add( options );

	// Preview

	var option = new UIRow();
	option.setClass( 'option' );
	option.setTextContent( strings.getKey( 'menubar/publish/preview' ) );
	option.onClick( async function () {

		var scene = editor.scene;
		var animations = getAnimations( scene );

		var { GLTFExporter } = await import( '../../examples/jsm/exporters/GLTFExporter.js' );

		var exporter = new GLTFExporter();

		exporter.parse( scene, function ( result ) {

			saveArrayBuffer( result, 'scene.glb' );

		}, { binary: true, animations: animations } );

	} );
	options.add( option );

	
	options.add( new UIHorizontalRule() );
	// Publish
	var option = new UIRow();
	option.setClass( 'option' );
	option.setTextContent( strings.getKey( 'menubar/publish/publish' ) );
	option.onClick( async function () {

		var scene = editor.scene;
		var animations = getAnimations( scene );

		var { GLTFExporter } = await import( '../../examples/jsm/exporters/GLTFExporter.js' );

		var exporter = new GLTFExporter();

		exporter.parse( scene, function ( result ) {

			// Create blob

			//saveArrayBuffer( result, 'scene.glb' );
			callPHP( new Blob( [ result ], { type: 'application/octet-stream' } ), 'scene.glb' );
			//callPHP(result,'scene.glb');

		}, { binary: true, animations: animations } );

	} );
	options.add( option );





    
	function save( blob, filename ) {
		const link = document.createElement( 'a' );

		if ( link.href ) {

			URL.revokeObjectURL( link.href );

		}

		link.href = URL.createObjectURL( blob );
		var urllink = "../build/index.html";
		let newWindow = window.open(urllink);
		newWindow.onload = () => {
			var blobHtmlElement;
			blobHtmlElement = document.createElement('model-viewer');
			blobHtmlElement.style.position = 'fixed';
			blobHtmlElement.style.top = '0';
			blobHtmlElement.style.left = '0';
			blobHtmlElement.style.bottom = '0';
			blobHtmlElement.style.right = '0';
			blobHtmlElement.style.width = '100%';
			blobHtmlElement.style.height = '100%';
			blobHtmlElement.setAttribute('ar',''); 
			blobHtmlElement.setAttribute('ar-modes', 'webxr scene-viewer quick-look'); 
			blobHtmlElement.setAttribute('camera-controls', 'webxr scene-viewer quick-look'); 
			blobHtmlElement.setAttribute('src', link.href); 
			newWindow.document.body.appendChild(blobHtmlElement);
			console.log(link.href);
		};

	}

	function saveArrayBuffer( buffer, filename ) {

		save( new Blob( [ buffer ], { type: 'application/octet-stream' } ), filename );

	}
 
	function callPHP( blob, filename ) {
		const link = document.createElement( 'a' );

		if ( link.href ) {

			URL.revokeObjectURL( link.href );

		}

		link.href = URL.createObjectURL( blob );
		link.download = filename || 'data.json';
		//link.dispatchEvent( new MouseEvent( 'click' ) );
		// Direct user to upload glb file
		alert("Please upload work in the next page!");
		var urllink = "../database/upload.php?username=user1";
		var newWindow = window.open(urllink);
		link.dispatchEvent( new MouseEvent( 'click' ) );

	}

	function getAnimations( scene ) {

		var animations = [];

		scene.traverse( function ( object ) {

			animations.push( ... object.animations );

		} );

		return animations;

	}

	return container;

}

export { MenubarPublish };
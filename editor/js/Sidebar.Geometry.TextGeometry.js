/*import * as THREE from '../../build/three.module.js';

import { UIRow, UIText, UIInteger, UINumber } from './libs/ui.js';

import { SetGeometryCommand } from './commands/SetGeometryCommand.js';

function GeometryParametersPanel( editor, object ) {

	var strings = editor.strings;

	var container = new UIRow();

	var geometry = object.geometry;
	var parameters = geometry.parameters;

	// radius

	var radiusRow = new UIRow();
	var radius = new UINumber( parameters.radius ).onChange( update );

	radiusRow.add( new UIText( strings.getKey( 'sidebar/geometry/circle_geometry/radius' ) ).setWidth( '90px' ) );
	radiusRow.add( radius );

	container.add( radiusRow );

	// segments

	var segmentsRow = new UIRow();
	var segments = new UIInteger( parameters.segments ).setRange( 3, Infinity ).onChange( update );

	segmentsRow.add( new UIText( strings.getKey( 'sidebar/geometry/circle_geometry/segments' ) ).setWidth( '90px' ) );
	segmentsRow.add( segments );

	container.add( segmentsRow );

	// thetaStart

	var thetaStartRow = new UIRow();
	var thetaStart = new UINumber( parameters.thetaStart * THREE.MathUtils.RAD2DEG ).setStep( 10 ).onChange( update );

	thetaStartRow.add( new UIText( strings.getKey( 'sidebar/geometry/circle_geometry/thetastart' ) ).setWidth( '90px' ) );
	thetaStartRow.add( thetaStart );

	container.add( thetaStartRow );

	// thetaLength

	var thetaLengthRow = new UIRow();
	var thetaLength = new UINumber( parameters.thetaLength * THREE.MathUtils.RAD2DEG ).setStep( 10 ).onChange( update );

	thetaLengthRow.add( new UIText( strings.getKey( 'sidebar/geometry/circle_geometry/thetalength' ) ).setWidth( '90px' ) );
	thetaLengthRow.add( thetaLength );

	container.add( thetaLengthRow );

	//

	function update() {

		editor.execute( new SetGeometryCommand( editor, object, new THREE.CircleGeometry(
			radius.getValue(),
			segments.getValue(),
			thetaStart.getValue() * THREE.MathUtils.DEG2RAD,
			thetaLength.getValue() * THREE.MathUtils.DEG2RAD
		) ) );

	}

	return container;

}

export { GeometryParametersPanel };
*/
import * as THREE from '../../build/three.module.js';

import { UIRow, UIText, UIInteger, UIButton } from './libs/ui.js';

import { SetGeometryCommand } from './commands/SetGeometryCommand.js';

function GeometryParametersPanel( editor, object ) {

	var strings = editor.strings;

	var container = new UIRow();

	var geometry = object.geometry;
	var parameters = geometry.parameters;

	// curveSegments

	var curveSegmentsRow = new UIRow();
	var curveSegments = new UIInteger( parameters.curveSegments || 12 ).onChange( changeShape ).setRange( 1, Infinity );

	curveSegmentsRow.add( new UIText( strings.getKey( 'sidebar/geometry/shape_geometry/curveSegments' ) ).setWidth( '90px' ) );
	curveSegmentsRow.add( curveSegments );

	container.add( curveSegmentsRow );

	// to extrude
	var button = new UIButton( strings.getKey( 'sidebar/geometry/shape_geometry/extrude' ) ).onClick( toExtrude ).setWidth( '90px' ).setMarginLeft( '90px' );
	container.add( button );

	//

	function changeShape() {

		editor.execute( new SetGeometryCommand( editor, object, new THREE.ShapeGeometry(
			parameters.shapes,
			curveSegments.getValue()
		) ) );

	}

	function toExtrude() {

		editor.execute( new SetGeometryCommand( editor, object, new THREE.ExtrudeGeometry(
			parameters.shapes, {
				curveSegments: curveSegments.getValue()
			}
		) ) );

	}

	return container;

}

export { GeometryParametersPanel };

import { UIPanel } from './libs/ui.js';


//remove
//import { MenubarAdd } from './Menubar.Add.js';
import { MenubarEdit } from './Menubar.Edit.js';
import { MenubarFile } from './Menubar.File.js';
import { MenubarExamples } from './Menubar.Examples.js';
import { MenubarView } from './Menubar.View.js';
import { MenubarHelp } from './Menubar.Help.js';
//remove
//import { MenubarPlay } from './Menubar.Play.js';
import { MenubarStatus } from './Menubar.Status.js';
//keep; crashes the editor if uncommented
/*import { MenubarPublish } from './Menubar.Publish.js';*/
import { MenubarPublish } from './Menubar.Publish.js';

function Menubar( editor ) {

	var container = new UIPanel();
	container.setId( 'menubar' );

	container.add( new MenubarFile( editor ) );
	container.add( new MenubarEdit( editor ) );
	//remove
	//container.add( new MenubarAdd( editor ) );
	//container.add( new MenubarPlay( editor ) );
	container.add( new MenubarExamples( editor ) );
	container.add( new MenubarView( editor ) );
	//keep
	//container.add( new MenubarPublish( editor ) );
	container.add( new MenubarHelp( editor ) );
	container.add( new MenubarPublish( editor ) );

	container.add( new MenubarStatus( editor ) );

	return container;

}

export { Menubar };

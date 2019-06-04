<style>
button {
  padding: 0px 10px;
  border: 1px solid #ddd;
  color: #333;
  background-color:#fff;
  border-radius: 4px;
  font-size: 14px;
  cursor: pointer;
}
.rowDiagram{
  height:100%;
}
.noselect {
  -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome and Opera */
}
body{
  overflow: scroll;
}
*,
::before,
::after {
    -webkit-box-sizing: content-box !important;
    -moz-box-sizing: content-box !important;
    box-sizing: content-box !important;
}

</style>
<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">

      <v-btn 
      slot="activator" 
      flat
      large
      >
       Diagrama de Descarga
      </v-btn>
      <v-card>
        <v-toolbar dark color="success">
          <v-btn icon dark @click="dialog = false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title class="white--text">{{title}}</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark flat color="success" @click="sendDiagram">Guardar</v-btn>
          </v-toolbar-items>
        </v-toolbar>
        <div>
          <!-- Creates a container for the splash screen -->
          <div id="splash"
            style="position:relative;top:0px;left:0px;width:100%;height:100%;background:white;z-index:1;">
            <center id="splash" style="padding-top:230px;">
              <img src="../../../resources/assets/images/loading.gif">
            </center>
          </div>
          
          <!-- Creates a container for the sidebar -->
          <div id="toolbarContainer"
            style='position:relative;white-space:nowrap;overflow:hidden;top:0px;left:0px;max-height:24px;height:36px;right:0px;padding:6px;'>
          </div>

          <div class="rowDiagram">
            <!-- Creates a container for the toolboox -->
            

            <div id="sidebarContainer"
              style="float: left;position:absolute;overflow-y: scroll;width:20%">
              <register ref="register"></register>
            </div>


            <!-- Creates a container for the graph -->
            <div id="graphContainer"
            style="position:absolute;overflow:scroll;"
             >
            </div>
          </div>
              <!-- Creates a container for the sidebar -->
        <div id="statusContainer"
          style="text-align:right;position:absolute;overflow:hidden;bottom:0px;left:0px;max-height:24px;height:36px;right:0px;color:white;padding:6px;">
        </div>
        </div>
      </v-card>
    </v-dialog>
  </v-layout>
 
</template>
<script type="text/javascript">
  import mx from 'mxgraph';

  const mxgraph = require("mxgraph")({
  mxImageBasePath: 'resources/assets/images/',// "@/node_modules/mxgraph/javascript/src/images",
  mxBasePath: "@/node_modules/mxgraph/javascript/src"
  });

   import register from "../components/RegisterComponent.vue";
  // import EnergySteamSource from "../components/EnergySteamSourceComponent.vue"
  // import PipeSource from "../components/PipeSourceComponent.vue"
  import { mapState } from 'vuex';

  var count=0;
  var export_xml = false

  var vertices = [];
  var information = {}
  var stateForm = {}
  var cellchose=null;
  var lastId = 0;
  var seleccion = null;
  
  /*const mxgraph = mx({
    mxBasePath: '/static/mxgraph'
  });*/
  const {
    mxCell,
    mxCellOverlay,
    mxConstants,
    mxConstraintHandler,
    mxConnectionConstraint,
    mxCellState,
    mxConnectionHandler,
    mxCodec,
    mxClient,
    mxDragSource,
    mxEdgeHandler,
    mxEditor,
    mxEvent,
    mxHierarchicalLayout,
    mxGeometry,
    mxGraph,
    mxGuide,
    mxGraphModel,
    mxGraphHandler,
    mxKeyHandler,
    mxImage,
    mxImageShape,
    mxMorphing,
    mxOutline,
    mxPerimeter,
    mxPoint,
    mxRectangle,
    mxCellRenderer,
    mxCellRendererCreateControl,
    mxShape,
    mxToolbar,
    mxUtils,
    mxPolyline,
    mxEdgeStyle,
    mxRubberband,
    mxFastOrganicLayout,
    mxLog,
  } = mxgraph;


  /*const editor = new mxEditor();
  const graph = editor.graph;
  const model = graph.getModel();*/

  const img_grid = require("../../../resources/assets/images/grid.gif")
  const img_toolbar = require("../../../resources/assets/images/toolbar_bg.gif")
  const img_cut = require('../../../resources/assets/images/cut.png')
  const img_copy = require('../../../resources/assets/images/copy.png')
  const img_paste = require('../../../resources/assets/images/paste.png')
  const img_delete2 = require('../../../resources/assets/images/delete2.png')
  const img_camera = require('../../../resources/assets/images/camera.png')
  const img_printer = require('../../../resources/assets/images/printer.png')
  const img_export = require('../../../resources/assets/images/export1.png')
  const img_minus = require('../../../resources/assets/images/navigate_minus.png')
  const img_plus = require('../../../resources/assets/images/navigate_plus.png')
  const img_view_next = require('../../../resources/assets/images/view_next.png')
  const img_view_previous = require('../../../resources/assets/images/view_previous.png')
  const img_zoom_in = require('../../../resources/assets/images/zoom_in.png')
  const img_zoom_out =  require('../../../resources/assets/images/zoom_out.png')
  const img_view_1_1 = require('../../../resources/assets/images/view_1_1.png')
  const img_fit_to_size = require('../../../resources/assets/images/fit_to_size.png')
  const img_group = require('../../../resources/assets/images/group.png')
  const img_connector = require('../../../resources/assets/images/connector.gif')
  const img_information = require('../../../resources/assets/images/information.png')
  const img_warning =  require('../../../resources/assets/images/warning.gif')
  const img_check = require('../../../resources/assets/images/map/overlays/check.png')


  export default {

    props: {
      title: String,
      sourceType: String,
    },
    data ()  {
      return{
        dialog: false,
        save: false,
        AllData:[],
        sources: {},
        addInicial : true,
        mapState: window.mapState,

        names:[],
        contador: 0,
        ids: [],
        counter:0,
        editor : new mxEditor(),
        graph: null,
        model: null,

      }
    },

    computed: mapState(['changeState']),
    created(){
      this.contador= 0
      this.graph= this.editor.graph
      this.model = this.graph.getModel()
    },
    mounted() {
      /*this.main(document.getElementById('graphContainer'),document.getElementById('outlineContainer'),document.getElementById('toolbarContainer'),document.getElementById('sidebarContainer'),document.getElementById('statusContainer'))*/
      this.main(document.getElementById('graphContainer'),document.getElementById('toolbarContainer'),document.getElementById('statusContainer'))      
    }, 
    watch:{
      changeState(newValue, oldValue){
        console.log("cambio ${oldValue} to ${newValue}")
        cellchose = this.model.getCell(information[seleccion])
        this.model.setStyle(cellchose, 'port;image='+img_check+';spacingLeft=18');
      },
    },
    methods:{
       main(container, toolbar, status)
      //main(container, outline, toolbar, sidebar, status)
      {
        var ref = this
        
        // Checks if the browser is supported
        if (!mxClient.isBrowserSupported())
        {
          // Displays an error message if the browser is not supported.
          mxUtils.error('Browser is not supported!', 200, false);
        }
        else
        {
          //console.log("informacion")
          //console.log( this.$store.getters.changeState)
          /*var editor = new mxEditor();
          var graph = editor.graph;
          var model = graph.getModel();*/
          
          // Assigns some global constants for general behaviour, eg. minimum
          // size (in pixels) of the active region for triggering creation of
          // new connections, the portion (100%) of the cell area to be used
          // for triggering new connections, as well as some fading options for
          // windows and the rubberband selection.  
          mxConstants.MIN_HOTSPOT_SIZE = 16;
          mxConstants.DEFAULT_HOTSPOT = 1;
          //new mxRubberband(graph);
          container.style.background  = "url("+img_grid+")"
          // sidebar.style.background = "#eeeeee"
          // sidebar.style.height = "85%"
          // sidebar.style.border = "1px solid #e0e0e0";
          toolbar.style.background = "whiteSmike"
          toolbar.style.border = "1px solid #e0e0e0";
          container.style.width = "90%"
          container.style.height = "85%"
          container.style.bottom = "26px"
          container.style.top = "102px"
          // sidebar.style.width= "155px"
          // sidebar.style.float= "left"
          status.style.background = "url("+img_toolbar+")"
          // Enables guides
          mxGraphHandler.prototype.guidesEnabled = true;
          mxConnectionHandler.prototype.connectImage = new mxImage(img_connector, 16, 16);

            // Alt disables guides
          mxGuide.prototype.isEnabledForEvent = function(evt)
          {
            return !mxEvent.isAltDown(evt);
          };

          // Enables snapping waypoints to terminals
         // mxEdgeHandler.prototype.snapToTerminals = true;

          // Workaround for Internet Explorer ignoring certain CSS directives
          if (mxClient.IS_QUIRKS)
          {
            document.body.style.overflow = 'hidden';
            new mxDivResizer(container);
            new mxDivResizer(toolbar);
            // new mxDivResizer(sidebar);
            new mxDivResizer(status);
          }
          
          // Disable highlight of cells when dragging from toolbar
          ref.graph.setDropEnabled(false);

          // Centers the port icon on the target port
          ref.graph.connectionHandler.targetConnectImage = true;

          // Does not allow dangling edges
          ref.graph.setAllowDanglingEdges(false);

          // Sets the graph container and configures the editor
          ref.editor.setGraphContainer(container);

          // Defines the default group to be used for grouping. The
          // default group is a field in the mxEditor instance that
          // is supposed to be a cell which is cloned for new cells.
          // The groupBorderSize is used to define the spacing between
          // the children of a group and the group bounds.
          var group = new mxCell('Group', new mxGeometry(), 'group');
          group.setVertex(true);
          group.setConnectable(false);
          //group.setConnectable(true);
          ref.editor.defaultGroup = group;
          ref.editor.groupBorderSize = 20;


          // Disables drag-and-drop into non-swimlanes.
          ref.graph.isValidDropTarget = function(cell, cells, evt)
          {
            return this.isSwimlane(cell);
          };
          
          // Disables drilling into non-swimlanes.
          ref.graph.isValidRoot = function(cell)
          {
            return this.isValidDropTarget(cell);
          }

          // Does not allow selection of locked cells
          ref.graph.isCellSelectable = function(cell)
          {           
            seleccion = cell.getId()            
            console.log(ref.$store.getters.changeState)
            //console.log(ref.$store.getters.changeState)
            return !this.isCellLocked(cell);
          };

          // Returns a shorter label if the cell is collapsed and no
          // label for expanded groups
          ref.graph.getLabel = function(cell)
          {
            var tmp = mxGraph.prototype.getLabel.apply(this, arguments); // "supercall"
            
            if (this.isCellLocked(cell))
            {
              // Returns an empty label but makes sure an HTML
              // element is created for the label (for event
              // processing wrt the parent label)
              return '';
            }
            else if (this.isCellCollapsed(cell))
            {
              var index = tmp.indexOf('</h1>');
              
              if (index > 0)
              {
                tmp = tmp.substring(0, index+5);
              }
            }
            
            return tmp;
          }


          ref.graph.connectionHandler.addListener(mxEvent.CONNECT, function(sender, evt)
          {
            var edge = evt.getProperty('cell');
            var source = ref.graph.getModel().getTerminal(edge, true);
            var target = ref.graph.getModel().getTerminal(edge, false);
            
            // get id source y target
            var nameSource = source.value.match(/>(.*?)<\/h4>/)[1].replace('<br>','').replace(/^\s+|\s+$/g, '')
            var nameTarget = target.value.match(/>(.*?)<\/h4>/)[1].replace('<br>','').replace(/^\s+|\s+$/g, '')
            var data = {}
            var data = ref.getIdSource(nameSource).then(data=>{
              axios.get('/api/source_types/sucessor/'+data)  
              .then(response => {
                  var sucessors = response.data
                  console.log(nameTarget)
                  console.log(sucessors)
                  var find = false
                  for (var val in sucessors){
                    console.log(val.name)
                    if (sucessors[val].name==nameTarget){
                      find=true
                      break
                    }
                  }
                  if (!find){
                    alert("no es un sucesor válido")
                    ref.model.remove(edge)
                  }
                }, error => {
                  console.log('error');          
              });
            })       
            var style = ref.graph.getCellStyle(edge);
            var sourcePortId = style[mxConstants.STYLE_SOURCE_PORT];
            var targetPortId = style[mxConstants.STYLE_TARGET_PORT];
            console.log('connect'+source.id+" "+target.id+" "+sourcePortId+" "+targetPortId);
          });

          // Removes cells when [DELETE] is pressed
          var keyHandler = new mxKeyHandler(ref.graph);
          keyHandler.bindKey(46, function(evt)
          {
            if (ref.graph.isEnabled())
            {
              ref.graph.removeCells();
            }
          });
          // Disables HTML labels for swimlanes to avoid conflict
          // for the event processing on the child cells. HTML
          // labels consume events before underlying cells get the
          // chance to process those events.
          //
          // NOTE: Use of HTML labels is only recommended if the specific
          // features of such labels are required, such as special label
          // styles or interactive form fields. Otherwise non-HTML labels
          // should be used by not overidding the following function.
          // See also: configureStylesheet.
          ref.graph.isHtmlLabel = function(cell)
          {
            return !this.isSwimlane(cell);
          }

          // To disable the folding icon, use the following code:
          /*graph.isCellFoldable = function(cell)
          {
            return false;
          }*/

          // Shows a "modal" window when double clicking a vertex.
          ref.graph.dblClick = function(evt, cell)
          {
            // Do not fire a DOUBLE_CLICK event here as mxEditor will
            // consume the event and start the in-place editor.
            if (this.isEnabled() &&
              !mxEvent.isConsumed(evt) &&
              cell != null &&
              this.isCellEditable(cell))
              {
                if (ref.model.isEdge(cell) ||
                  !this.isHtmlLabel(cell))
                {
                  this.startEditingAtCell(cell);
                }
                else
                {
                  var content = document.createElement('div');
                  content.innerHTML = this.convertValueToString(cell);
                  //alert(cell.getId())
                }
              }

            // Disables any default behaviour for the double click
            mxEvent.consume(evt);
          };

          // Enables new connections
          ref.graph.setConnectable(true);

          // Adds all required styles to the graph (see below)
          ref.configureStylesheet(ref.graph);

          // Adds sidebar icons.
          //
          // NOTE: For non-HTML labels a simple string as the third argument
          // and the alternative style as shown in configureStylesheet should
          // be used. For example, the first call to addSidebar icon would
          // be as follows:
          // addSidebarIcon(graph, sidebar, 'Website', 'images/icons48/earth.png');
          var changeTypeSource = ''
          // if (this.sourceType){
          //   var data =  this.sources
          //   axios.get('/api/source_types/'+this.sourceType)  
          //   .then(response => {
          //       this.sources = response                 
          //       for (var key in this.sources.data){                     
          //         this.names.push(this.sources.data[key].name)
          //         var fuente = this.sources.data[key].name
          //         var type = this.sources.data[key].type
          //         var sourceId = this.sources.data[key].id
          //         var color = this.sources.data[key].color
          //         var config = {}
          //         config.button = '<button class="generate" '
          //         config.nameSource = fuente
          //         config.sourceId = sourceId
          //         config.style= "fillColor="+color
          //         config.color=color
          //         config.type=type
          //         config.process=this.sources.data[key].process
          //         if (changeTypeSource != type){
          //           // ref.addTypeSourceSidebar(sidebar,type,'h4')
          //           changeTypeSource=type
          //         }
          //         var fuenteText = fuente
          //         if (fuente.length>18){
          //           fuente = this.addBrText(fuente)
          //         }
          //         if (type == "PROCESO"){
          //           config.button=''
          //         }
          //         ref.addSidebarIcon(ref.graph, sidebar,'<h4 style="margin:0px;">'+fuente+'</h4><br>',            
          //         fuenteText,config);
          //       }       
          //     }, error => {
          //       console.log('error');          
          //   });
          // }
          // Displays useful hints in a small semi-transparent box.
          
          // Creates a new DIV that is used as a toolbar and adds
          // toolbar buttons.
          var spacer = document.createElement('div');
          spacer.style.display = 'inline';
          spacer.style.padding = '8px';
          
          //ref.addToolbarButton(editor, toolbar, 'groupOrUngroup', '(Un)group', 'images/group.png');
          
          // Defines a new action for deleting or ungrouping
          ref.editor.addAction('groupOrUngroup', function(editor, cell)
          {
            cell = cell || ref.editor.graph.getSelectionCell();
            if (cell != null && ref.editor.graph.isSwimlane(cell))
            {
              ref.editor.execute('ungroup', cell);
            }
            else
            {
              ref.editor.execute('group');
            }
          });

          ref.addToolbarButton(ref.editor, toolbar, 'delete', 'Eliminar', img_delete2);
          
          toolbar.appendChild(spacer.cloneNode(true));
          
          /*ref.addToolbarButton(ref.editor, toolbar, 'cut', 'Cortar', img_cut);
          ref.addToolbarButton(ref.editor, toolbar, 'copy', 'Copiar', img_copy);
          ref.addToolbarButton(ref.editor, toolbar, 'paste', 'Pegar', img_paste);

          toolbar.appendChild(spacer.cloneNode(true));*/
          
          //ref.addToolbarButton(editor, toolbar, 'undo', '', img_undo);
          //ref.addToolbarButton(editor, toolbar, 'redo', '', img_redo);
          
          toolbar.appendChild(spacer.cloneNode(true));
          
          ref.addToolbarButton(ref.editor, toolbar, 'show', 'Mostrar', img_camera);
          ref.addToolbarButton(ref.editor, toolbar, 'print', 'Imprimir', img_printer);
          ref.addToolbarButton(ref.editor, toolbar, 'save', 'Guardar', img_printer);
          ref.editor.addAction('save', function(editor, cell)
          {
            var enc = new mxCodec(mxUtils.createXmlDocument());
            var node = enc.encode(ref.editor.graph.getModel());
            //console.log(mxUtils.getPrettyXml(node));  
          });

          toolbar.appendChild(spacer.cloneNode(true));

          // Defines a new export action
          // ref.editor.addAction('export', function(editor, cell)
          // {
            ref.addInicial=false
            var enc = new mxCodec(mxUtils.createXmlDocument());
            var node = enc.encode(ref.editor.graph.getModel());
            //console.log(mxUtils.getPrettyXml(node));       
            var req = mxUtils.load("../../../xml/xml.xml");
            var xmlText = req.getText();
            //console.log(xmlText)
            // use the DOMParser browser API to convert text to a Document
            var XML = new DOMParser().parseFromString(xmlText, "text/xml");
            var parser = require('fast-xml-parser');
            var he = require('he');
 
            var options = {
                attributeNamePrefix : "",
                attrNodeName: "attr", //default is 'false'
                textNodeName : "#text",
                ignoreAttributes : false,
                ignoreNameSpace : false,
                allowBooleanAttributes : false,
                parseNodeValue : true,
                parseAttributeValue : false,
                trimValues: true,
                cdataTagName: "__cdata", //default is 'false'
                cdataPositionChar: "\\c",
                localeRange: "", //To support non english character in tag/attribute values.
                parseTrueNumberOnly: false,
                attrValueProcessor: a => he.decode(a, {isAttributeValue: true}),//default is a=>a
                tagValueProcessor : a => he.decode(a) //default is a=>a
            };
            var tObj = parser.getTraversalObj(xmlText,options);
            var jsonObj = parser.convertToJson(tObj,options);
            //console.log(JSON.stringify(jsonObj));
            ref.readXML(jsonObj)
            //export_xml=true

          // });
          
          ref.addToolbarButton(ref.editor, toolbar, 'export', 'Exportar', img_export);

          // ---
          this.editEdges = false
          ref.graph.setCellsResizable(false)
          //raph.setCellsEditable(false)
          // Adds toolbar buttons into the status bar at the bottom
          // of the window.
          ref.addToolbarButton(ref.editor, status, 'collapseAll', 'Collapse All', img_minus, true);
          ref.addToolbarButton(ref.editor, status, 'expandAll', 'Expand All', img_plus, true);

          status.appendChild(spacer.cloneNode(true));
          
          ref.addToolbarButton(ref.editor, status, 'enterGroup', 'Enter', img_view_next, true);
          ref.addToolbarButton(ref.editor, status, 'exitGroup', 'Exit', img_view_previous, true);

          status.appendChild(spacer.cloneNode(true));

          ref.addToolbarButton(ref.editor, status, 'zoomIn', '', img_zoom_in, true);
          ref.addToolbarButton(ref.editor, status, 'zoomOut', '',  img_zoom_out, true);
          ref.addToolbarButton(ref.editor, status, 'actualSize', '', img_view_1_1, true);
          ref.addToolbarButton(ref.editor, status, 'fit', '', img_fit_to_size, true);
          
          // Creates the outline (navigator, overview) for moving
          // around the graph in the top, right corner of the window.
          //var outln = new mxOutline(graph, outline);

          // To show the images in the outline, uncomment the following code
          //outln.outline.labelsVisible = true;
          //outln.outline.setHtmlLabels(true);
          
          // Fades-out the splash screen after the UI has been loaded.
          var splash = document.getElementById('splash');
          if (splash != null)
          {
            try
            {
              mxEvent.release(splash);
              mxEffects.fadeOut(splash, 100, true);
            }
            catch (e)
            {
            
              // mxUtils is not available (library not loaded)
              splash.parentNode.removeChild(splash);
            }
          }
        }
      },
      configureStylesheet(graph)
      {
        var ref=this
        var style = new Object();
        style[mxConstants.STYLE_SHAPE] = mxConstants.SHAPE_RECTANGLE;
        style[mxConstants.STYLE_PERIMETER] = mxPerimeter.RectanglePerimeter;
        style[mxConstants.STYLE_ALIGN] = mxConstants.ALIGN_CENTER;
        style[mxConstants.STYLE_VERTICAL_ALIGN] = mxConstants.ALIGN_MIDDLE;
        style[mxConstants.STYLE_STROKECOLOR] = '#000000';
        style[mxConstants.STYLE_FONTCOLOR] = '#000000';
        style[mxConstants.STYLE_OPACITY] = '80';
        style[mxConstants.STYLE_FONTSIZE] = '12';
        style[mxConstants.STYLE_FONTSTYLE] = 0;
        style[mxConstants.STYLE_IMAGE_WIDTH] = '48';
        style[mxConstants.STYLE_IMAGE_HEIGHT] = '48';
        ref.graph.getStylesheet().putDefaultVertexStyle(style);

        style = new Object();
        style[mxConstants.STYLE_SHAPE] = mxConstants.SHAPE_SWIMLANE;
        style[mxConstants.STYLE_PERIMETER] = mxPerimeter.RectanglePerimeter;
        style[mxConstants.STYLE_ALIGN] = mxConstants.ALIGN_CENTER;
        style[mxConstants.STYLE_VERTICAL_ALIGN] = mxConstants.ALIGN_TOP;
        style[mxConstants.STYLE_FILLCOLOR] = '#FF9103';
        style[mxConstants.STYLE_GRADIENTCOLOR] = '#F8C48B';
        style[mxConstants.STYLE_STROKECOLOR] = '#E86A00';
        style[mxConstants.STYLE_FONTCOLOR] = '#000000';
        style[mxConstants.STYLE_ROUNDED] = true;
        style[mxConstants.STYLE_OPACITY] = '80';
        style[mxConstants.STYLE_STARTSIZE] = '30';
        style[mxConstants.STYLE_FONTSIZE] = '16';
        style[mxConstants.STYLE_FONTSTYLE] = 1;
        ref.graph.getStylesheet().putCellStyle('group', style);
        
        style = new Object();
        style[mxConstants.STYLE_SHAPE] = mxConstants.SHAPE_IMAGE;
        style[mxConstants.STYLE_FONTCOLOR] = '#774400';
        style[mxConstants.STYLE_PERIMETER] = mxPerimeter.RectanglePerimeter;
        style[mxConstants.STYLE_PERIMETER_SPACING] = '6';
        style[mxConstants.STYLE_ALIGN] = mxConstants.ALIGN_LEFT;
        style[mxConstants.STYLE_VERTICAL_ALIGN] = mxConstants.ALIGN_MIDDLE;
        style[mxConstants.STYLE_FONTSIZE] = '10';
        style[mxConstants.STYLE_FONTSTYLE] = 2;
        style[mxConstants.STYLE_IMAGE_WIDTH] = '16';
        style[mxConstants.STYLE_IMAGE_HEIGHT] = '16';
        ref.graph.getStylesheet().putCellStyle('port', style);
        
        style = ref.graph.getStylesheet().getDefaultEdgeStyle();
        style[mxConstants.STYLE_LABEL_BACKGROUNDCOLOR] = '#000000';
        style[mxConstants.STYLE_STROKEWIDTH] = '1';
        style[mxConstants.STYLE_ROUNDED] = true;
        style[mxConstants.STYLE_STROKECOLOR] = '#000000';
        style[mxConstants.STYLE_EDGE] = mxEdgeStyle.SideToSide;
      },
      addBrText(text)
      {
         var arrayText= text.split(" ")
         var sum = 0
         var i=0
         var n=arrayText.length
         var newText=""
         while (i<n){
          sum+=arrayText[i].length
          if (sum > 18){
            newText+="<br>"
            sum=0
          }else{
            newText+=arrayText[i]+" "
            i+=1
          }
        }
        return newText
      },
      addTypeSourceSidebar(sidebar,text,tag){
        var ref=this
        var para = document.createElement(tag);
        var t = document.createTextNode(text);
        para.appendChild(t);
        para.className="noselect"
        para.style.margin="5px"
        para.style.padding="5px"
        sidebar.appendChild(para);
      },
      addSidebarIcon(graph, sidebar, label, text, config)
      {
        // Function that is executed when the image is dropped on
        // the graph. The cell argument points to the cell under
        // the mousepointer if there is one.
        var ref=this
        //var model = ref.graph.getModel();

        //ref.mapState.initMap = false

        var funct = function(graph, evt, cell, x, y)
        {
          var parent = ref.graph.getDefaultParent();
          //var model = graph.getModel();
          
          var v1 = null;
          ref.model.beginUpdate();
          try
          {

            // NOTE: For non-HTML labels the image must be displayed via the style
            // rather than the label markup, so use 'image=' + image for the style.
            // as follows: v1 = graph.insertVertex(parent, null, label,
            // pt.x, pt.y, 120, 120, 'image=' + image);
            //
            var html = label
            if (config.button){
              html+=config.button+'source='+config.sourceId+' id="id'+count+'">Registrar</button>'
            }
            v1 = ref.graph.insertVertex(parent,null, html, x, y, 120, 80,config.style);
            v1.setAttribute('label', 'hola');
            vertices[v1.getId()]=v1 
            //v1.setConnectable(false);            
            if (ref.addInicial){                          
              var v2 = ref.graph.insertVertex(parent, null, 'Inicio', 200, 200, 80, 60,'shape=ellipse;perimeter=ellipsePerimeter'); 
              lastId = v2.getId()
              ref.addInicial=false
              ref.graph.insertEdge(parent, null, "", v2, v1); 
            }
            // obtengo el id alert(v1.getId())
            v1.setConnectable(true);

            if (config.button){
              var style = '<img src="'+img_warning+'">'
              var port = ref.graph.insertVertex(v1, null, config.sourceId, 1, 0.75, 16, 16,'port;image='+img_warning+';spacingLeft=18', true);                
              lastId = v1.getId()
              information[v1.getId()]=port.getId()
              port.geometry.offset = new mxPoint(-8, -4);
              port.setConnectable(false)
            }

          }
          finally
          {
            ref.model.endUpdate();
            if (config.button){
              //alert(count)
              var generate = document.getElementById('id'+count)
              v1.setAttribute('firstName', 'ignacioo');
              if (generate.addEventListener) {  // all browsers except IE before version 9
                  try{
                    generate.addEventListener("click", function(){ 
                      if (config.type == "CHIMENEA"){
                        ref.openModalPipeSource(v1.getId())
                      }else{
                        ref.openModal(v1.getId(),config)  
                      }                      
                    }, false);
                  } catch(e){
                      console.log("Error")
                  }                                    
              } else {
                if (generate.attachEvent) {   // IE before version 9
                  if (config.type == "CHIMENEA"){
                    generate.attachEvent("click", ref.openModalPipeSource)
                  }else{
                    generate.attachEvent("click", ref.openModal);  
                  }
                  
                  //generateId.attachEvent("click", ref.showModalWindow);
                }
              }             
              console.log(ref.counter)
            }
            count++;
            ref.counter++;
            ref.contador++;
          }          
        }
          // Creates the p which is used as the sidebar icon (drag source)
        var para = document.createElement("p");
        var t = document.createTextNode(text);
        para.appendChild(t);
        para.className="noselect"
        para.style.border="dashed black 1px"
        para.style.background=config.color
        para.style.margin="5px"
        para.style.padding="5px"
        sidebar.appendChild(para);

        var dragElt = document.createElement('div');
        dragElt.style.border = 'dashed black 1px';
        dragElt.style.width = '120px';
        dragElt.style.height = '80px';

        var ds = mxUtils.makeDraggable(para, ref.graph, funct, dragElt, 0, 0, true, true);
        ds.setGuidesEnabled(true);                  
      },

      addEventClick(config){
        var ref=this
        console.log(JSON.stringify(config))
        //alert("id"+config.idHtmlCell)        
        //var generation = document.getElementById("id2")
        for (var c in config){
          console.log("aquiiiii: "+document.getElementById(config[c].idHtmlCell))
        }
        var generation = document.getElementsByClassName("generate")
        //alert("generation "+generation)
        //alert(generate)
        //alert(document.getElementById("id"+config.idHtmlCell))
        var i = 0;
        for (i; i<generation.length;i++){

          console.log(" aqui : "+config[i].idHtmlCell)
          //var ca = document.getElementById(config[i].idHtmlCell)
          //alert(ca[generate].idHtmlCell)
          if (generation[i].addEventListener) {  // all browsers except IE before version 9
              (function(x){
                generation[x].addEventListener("click", function(){ 

                  ref.openModal(config[x],config[x])
                  /*if (config[i].type == "CHIMENEA"){
                    alert("es chimenea")
                    ref.openModalPipeSource(config[i])
                  }else{
                    alert("no es chimenea")
                    ref.openModal(config[i],config[i])  
                  }       */               
                }, false);
              })(i)                     
          } else {
            if (ca[generate].attachEvent) {   // IE before version 9
              if (config.type == "CHIMENEA"){
                ca[generate].attachEvent("click", ref.openModalPipeSource)
              }else{
                ca[generate].attachEvent("click", ref.openModal);  
              }
            }
          }  
        }         
        /*count++;
        ref.counter++;
        ref.contador++;*/
      },
      addToolbarButton(editor, toolbar, action, label, image, isTransparent)
      {
        var button = document.createElement('button');
        button.style.fontSize = '10';
        if (image != null)
        {
          var img = document.createElement('img');
          img.setAttribute('src', image);
          img.style.width = '16px';
          img.style.height = '16px';
          img.style.verticalAlign = 'middle';
          img.style.marginRight = '2px';
          button.appendChild(img);
        }
        if (isTransparent)
        {
          button.style.background = 'transparent';
          button.style.color = '#FFFFFF';
          button.style.border = 'none';
        }
        mxEvent.addListener(button, 'click', function(evt)
        {
          if (action=="delete"){
            if (count>=1){
              count--; 
              var cell = editor.graph.getSelectionCell();
              for (var propiedad in vertices) {
                  //console.log(propiedad)
              }  
              delete  (vertices[cell.getId()]);
            }
          }
          editor.execute(action);          
        });
        mxUtils.write(button, label);
        toolbar.appendChild(button);
      },
      openModalPipeSource(value){
        var ref=this
        ref.$refs.PipeSource.showSpecific(value) 
      },
      openModal(value,config) {
        var ref=this
        ref.$store.commit('changeStateCell', false)
        if (export_xml){          
          ref.$refs.register.show(value,this.AllData)           
        }else{          
          ref.$refs.register.showSpecific(value,config)
        }        
      },
      readXML(arr){
        var ref=this
        var parent = ref.graph.getDefaultParent();
        var rec =arr["mxGraphModel"]["root"]["mxCell"]        
         var ca = null

        for (var key in rec){
          var value = ""
          var id = ""
          var style = ""
          
          var idParent = ""
          ref.model.beginUpdate();
          try
          { 
            
            for (var key2 in rec[key]){
              var valueKey = rec[key][key2]
              var needAction = false
              if (valueKey.hasOwnProperty("value")){
                value = valueKey.value
                id = valueKey.id
              }
              if (valueKey.hasOwnProperty("style")){
                style = valueKey.style
                idParent = valueKey.parent
              }
              if (valueKey.hasOwnProperty("attr")){                  
                  if(valueKey["attr"].hasOwnProperty("x")){
                    var x = Number(valueKey.attr.x)
                    var y = Number(valueKey.attr.y)
                    var width = Number(valueKey.attr.width)
                    var height = Number(valueKey.attr.height)
                    if (idParent != "1"){
                      var xx = valueKey.mxPoint.attr.x
                      var yy = valueKey.mxPoint.attr.y 
                      style ='port;image='+img_warning+';spacingLeft=18'
                      var port = ref.graph.insertVertex(vertices[idParent], id, value, Number(x), Number(y), Number(width), Number(height), style,true) 
                      information[idParent]=port.id
                      vertices[id]=port
                      console.log(JSON.stringify(valueKey))
                      port.geometry.offset = new mxPoint(Number(xx), Number(yy));
                      port.setConnectable(false)
                      needAction=true 
                    }else{                  
                      var config = {}   
                      vertices[id] = ref.graph.insertVertex(parent, id, value, x, y, width, height, style);
                      var res=value.search(/id=\"id/)
                      count++
                    
                      if (res!=-1){    
                        config.sourceId= value.match(/source=([0-9]+)/)[1];                    
                        config.idHtmlCell='id'+value.match(/id([0-9]+)/)[1];
                        config.nameSource = value.match(/>(.*?)<\/h4>/)[1].replace('<br>','').replace(/^\s+|\s+$/g, '')
                        config.idCell = id
                       // alert(config.sourceId)
                        var esChimenea=value.search(/Chimenea/)
                        if (esChimenea!=-1){
                          config.type='CHIMENEA'
                        }else{
                          config.type=''
                        }

                        /*await axios.get('/api/source_types/id_source/'+config.nameSource)  
                        .then(response => {
                            config.sourceId=response.data
                          }, error => {
                            console.log('error');          
                        });*/
                        ref.ids.push(config)
                      }
                      vertices[id].setConnectable(true);
                                           
                    }                                                             
                }
              }
              if (valueKey.hasOwnProperty("edge")){
                var source= vertices[valueKey.source]
                var target= vertices[valueKey.target]
                var value = valueKey.value
                if (source != "" && target != ""){
                  ref.graph.insertEdge(parent, null, value, source, target);  
                  console.log("aqui ")
                 // 
                }
              }
            }
          }
          finally{            
            ref.model.endUpdate();
            console.log("Fin")
            
            if (needAction){

              /*console.log("aquiiiii: "+document.getElementById("id0"))
              alert(config.idHtmlCell)
              console.log(JSON.stringify(config))*/
  // all browsers except IE before version 9
                (function(x){
                                ca = document.getElementById(x.idHtmlCell)
                  if (ca.addEventListener) {
                  ca.addEventListener("click", function(){                     
                    if (x.type == "CHIMENEA"){
                      ref.openModalPipeSource(x.idCell)
                    }else{
                      ref.openModal(x.idCell,x)  
                    }                      
                  }, false); 
                  } 
                })(config)
              /*} else {
                console.log("AÑADIR EVENTO x")
                if (ca.attachEvent) {   // IE before version 9
                  if (config.type == "CHIMENEA"){
                    ca.attachEvent("click", ref.openModalPipeSource)
                  }else{
                    ca.attachEvent("click", ref.openModal);  
                  }
                }
              } */               
            
            }  
          }
        }
        //ref.model.endUpdate();
        /*if (needAction){
              console.log(JSON.stringify(config));
              
              
             }*/


        //ref.addEventClick(ref.ids) 
    },
    sendDiagram(){
      this.dialog=false 
      this.$store.commit('changeCurrentWizardStep', 2);
    },
    getIdSource(value){
      return axios.get('/api/source_types/id_source/'+value)  
      .then(response => {
          return response.data       
        }, error => {
          console.log('error');          
      });
    },
  }
}
</script>
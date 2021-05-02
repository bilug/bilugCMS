<? /* license

BilugCMS (http://www.bilug.it) - Content Management System for dynamic web sites
Copyright (C) 2005-2008  Federico Villa and Alessio Loro Piana

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

For reference, contact bilugcms@vilnet.it


license */ ?>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script language="Javascript" type="text/javascript">
//<![CDATA[
    google.load('search', '1',{"nooldnames" : true,"language" : "it"});
    
    function OnLoad() {
      // Create a search control
      var searchControl = new google.search.SearchControl();

      // Add in a full set of searchers
      var localSearch = new google.search.LocalSearch();
		searchControl.addSearcher(new google.search.WebSearch());      
      searchControl.addSearcher(localSearch);      
      searchControl.addSearcher(new google.search.VideoSearch());
      searchControl.addSearcher(new google.search.BlogSearch());
      searchControl.addSearcher(new google.search.NewsSearch());
      searchControl.addSearcher(new google.search.ImageSearch());
      searchControl.addSearcher(new google.search.BookSearch());
      searchControl.addSearcher(new google.search.PatentSearch());

      // Set the Local Search center point
      localSearch.setCenterPoint("Biella, IT");
      
      // create a drawOptions object
		var drawOptions = new google.search.DrawOptions();
		
		// tell the searcher to draw itself in tabbed mode
		drawOptions.setDrawMode(google.search.SearchControl.DRAW_MODE_TABBED);
		
		// tell the searcher to request a large number of results (typically 8 results)
		searchControl.setResultSetSize(google.search.Search.LARGE_RESULTSET);
		
		// write a default string if no result 
		searchControl.setNoResultsString(google.search.SearchControl.NO_RESULTS_DEFAULT_STRING);
		
      // tell the searcher to draw itself and tell it where to attach
      searchControl.draw(document.getElementById("searchcontrol"), drawOptions);

      // execute an inital search
      
      searchControl.execute('<?=$_POST['testo']?>');
    }
    google.setOnLoadCallback(OnLoad);

    //]]>
    </script>
<div id="searchcontrol" ><img src="<?=_URLSITO?>/img/ajaxLoader.gif" width="220" height="19" alt="" /> Loading...</div>
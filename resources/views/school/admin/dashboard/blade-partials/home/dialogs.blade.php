<!-- Templates -->
<script type="text/ng-template" id="addNewSessionDialog.html">
    <div class="">
        <div class="panel">
            <div class="row" style="padding: 15px">
                <h3 class="mt0">Add New Session</h3>
                <form>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <span class="btn btn-default" ng-click="lastSession(current)">
                                <span class="fa fa-chevron-left"></span>
                            </span>
                        </div>
                        <div class="col-sm-8">
                            <span>
                                <input type="text" placeholder="2014/2015"
                                       class="form-control"
                                       ng-model="current.current_session"
                                       masked=""
                                       readonly="readonly"
                                       ng-disabled="current.saving || current.loading"
                                       data-inputmask="'mask': '9999/9999'"/>
                            </span>

                        </div>
                        <div class="col-sm-2">
                            <span class="btn btn-default" ng-click="nextSession(current)">
                                    <span class="fa fa-chevron-right"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row mt5">
                        <div class="col-sm-12">
                            <button type="button"
                                    ng-click="closeThisDialog('cancel')"
                                    class="btn btn-default mr">Cancel
                            </button>
                            <button type="button"
                                    ng-click="saveCurrentSessionTerm(current,closeThisDialog);"
                                    class="btn btn-primary">Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</script>


<script type="text/ng-template" id="firstDialog">
    <div class="ngdialog-message">
        <h2>Native Angular.js solution</h2>
        <div>With ngDialog you don't need jQuery or Bootstrap to create dialogs for <code>ng-app:</code></div>
        <ul class="mt">
            <li>Use it in controllers, factories or directives</li>
            <li>Create your own directives</li>
            <li>Style all UI and templates</li>
            <li>Configure themes</li>
            <li>Add animations and effects</li>
        </ul>
        <div class="mt">Module is shipped with both <code>ngDialog</code> service and default directive.</div>
    </div>
    <div class="ngdialog-buttons mt">
        <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="next()">►</button>
    </div>
</script>

<script type="text/ng-template" id="secondDialog">
    <div class="ngdialog-message">
        <h2>And even more!</h2>
        <ul class="mt">
            <li>Load your templates as strings, ng-template tags or html partials</li>
            <li>ngDialog.js is < 2kb when minified!</li>
            <li>It has simple, extendable and elegant API ;)</li>
        </ul>
        <div class="mt">Spread a word about it:</div>
    </div>
    <div class="mt">
        <a href="http://twitter.com/home?status=ngDialog.js - modal windows and popups provider for Angular.js applications, via @likeastore!+http://likeastore.github.io/ngDialog/" class="action-btn" ng-like>Tweet</a>
        <a href="http://www.facebook.com/share.php?u=http://likeastore.github.io/ngDialog" class="action-btn" ng-like>Like</a>
        <a href="https://github.com/likeastore/ngDialog#ngdialog" class="action-btn read" target="_blank">Read docs</a>
    </div>
</script>
<main>
    <div class="container">
        <?php if ($this->IsAccountAdmin()):?>
            <article>
                <h1 class="page-header"><?php $this->T("ACCOUNTS");?></h1>

                <table class="table" id="accounts-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </article>
        <?php endif;?>

        <article>
            <h1 class="page-header"><?php $this->T("TRANSLATIONS");?></h1>

            <button class="btn btn-primary m-b-1" type="button" id="translation-add">
                &#43; <?php $this->T("BE_NEW_TRANSLATION");?>
            </button>

            <div class="row" id="translations-row"></div>

            <h2 class="page-header"><?php $this->T("VARIABLES");?></h2>
            <p><?php $this->T("BE_VARIABLES_INTRO");?></p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Variable</th>
                        <th><?php $this->T("DESCRIPTION");?></th>
                        <th><?php $this->T("VALUE");?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>{r}</code></td>
                        <td>RootUrl</td>
                        <td><?php r();?></td>
                    </tr>
                </tbody>
            </table>
        </article>
    </div>
</main>

<section class="tpl-area">
	<article id="tpl-translation">
        <div class="col-md-4 translation" data-id="">
            <div class="card">
                <div class="card-block">
                    <div class="translation-keyword form-group">
                        <label><?php $this->T("KEYWORD");?></label>
                        <input class="translation-input form-control" type="text" data-col-name="Keyword">
                    </div>
                    <div class="translation-english form-group">
                        <label><?php $this->T("ENGLISH");?></label>
                        <textarea class="translation-input form-control" data-col-name="English"></textarea>
                    </div>
                    <div class="translation-german form-group">
                        <label><?php $this->T("GERMAN");?></label>
                        <textarea class="translation-input form-control" data-col-name="German"></textarea>
                    </div>

                    <button class="translation-delete-btn btn btn-outline-danger" type="button">
                        &#128465;
                        <?php $this->T("DELETE");?>
                    </button>  
                </div>
            </div>
        </div>
	</article>
</section>
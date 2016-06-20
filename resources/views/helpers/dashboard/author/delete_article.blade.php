<!-- Modal window -->
<div id="delete_article" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="hide_modal('delete_article')" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Удаление статьи</h4>
            </div>
            <div class="modal-body">
                <p>Вы действительно хотите удалить данную статью?</p>
            </div>
            <div class="modal-footer">
                <button onclick="hide_modal('delete_article')" type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <a href="/dashboard/author/articles/{{ $data['article']->id }}/delete" title="Удалить" class="btn btn-danger">Удалить</a>
            </div>
        </div>
    </div>
</div>
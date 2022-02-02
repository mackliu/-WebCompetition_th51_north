



<div class="modal fade" id="CopyModal" tabindex="-1" role="dialog" aria-labelledby="CopyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CopyModalLabel">複製問卷</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="api/copy_quiz.php" method="post" id="CopyForm">
      <div class="modal-body">
        <div class="container">
            
                <div class="text-center col-12 m-auto font-weight-bolder" style="font-size:20px">請選擇複製方式：</div>
                <div class="col-10 mx-auto mt-2">
                    <input type="radio" name="type" value="quiz" checked>只複製題目<br>
                    <input type="radio" name="type" value="log">複製題目和問卷
                    <input type="hidden" name="id" value="<?=$_GET['id'];?>">
                </div>

            
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="save-quiz btn btn-primary">儲存</button> -->
        <input type="submit" class='btn btn-primary' value="確定複製">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
      </div>
      </form>
    </div>
  </div>
</div>

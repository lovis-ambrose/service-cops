import { Component, Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';

@Component({
  selector: 'app-post-action',
  templateUrl: './post-action.component.html',
  styleUrl: './post-action.component.scss'
})
export class PostActionComponent {
  post = { 
    title: '', 
    body: '' 
  };

  constructor(
    public dialogRef: MatDialogRef<PostActionComponent>,
    @Inject(MAT_DIALOG_DATA) public data: any
  ) {
    if (data.post) {
      this.post = data.post;  // populate the form for update/patch if post data is provided
    }
  }


  patchPost(): void {
    // to-do: Patch post logic
    this.dialogRef.close(this.post);
  }

  updatePost(): void {
    // to-do: Update post logic
    this.dialogRef.close(this.post);
  }

  onSave(): void {
    // to-do: Add post logic
    this.dialogRef.close(this.post);
  }

  onCancel(): void {
    this.dialogRef.close();
  }
}

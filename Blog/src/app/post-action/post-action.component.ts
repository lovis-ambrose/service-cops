import { Component } from '@angular/core';
import { MatDialogRef } from '@angular/material/dialog';

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
    public dialogRef: MatDialogRef<PostActionComponent>
  ) {}

  onSave(): void {
    // to-do Save

    this.dialogRef.close(this.post);
  }

  onCancel(): void {
    this.dialogRef.close();
  }
}

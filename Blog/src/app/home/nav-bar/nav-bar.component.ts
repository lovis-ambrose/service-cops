import { Component } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { PostActionComponent } from '../../post-action/post-action.component';

@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrl: './nav-bar.component.scss'
})
export class NavBarComponent {
  constructor(
    private dialog: MatDialog
  ) {}


  openAddDialog() {
    this.dialog.open(PostActionComponent, {
      data: { action: 'add' }
    });
  }
}

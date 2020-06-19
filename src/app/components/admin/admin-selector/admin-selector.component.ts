import { Component, Output, EventEmitter } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'adk-admin-selector',
  templateUrl: './admin-selector.component.html',
  styleUrls: ['./admin-selector.component.css']
})
export class AdminSelectorComponent {

  constructor(private router: Router) {
  }

  ngOnInit() {
  }
}
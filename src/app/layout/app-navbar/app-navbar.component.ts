import { Component, OnInit } from '@angular/core';
import { NgbModule, NgbDropdown } from '@ng-bootstrap/ng-bootstrap';
import { TokenStorageService } from '../../components/shared/security/token-storage.service';
import { Router, NavigationStart } from '@angular/router';

@Component({
  selector: 'app-navbar',
  templateUrl: './app-navbar.component.html',
  styleUrls: ['./app-navbar.component.css']
})
export class AppNavbarComponent implements OnInit {
  public isCollapsed = true;

  
  constructor(private tokenStorageService: TokenStorageService,
    private router: Router) { }

  ngOnInit() {
    this.router.events.subscribe((ev) => {
        if (ev instanceof NavigationStart) {
          this.isCollapsed = true;
        }
      });
  }

  public toggleCollapsed(): void {
    this.isCollapsed = !this.isCollapsed;
  }

  public closeCollapsed(): void {
    this.isCollapsed = true;
  }

  public closeDropdown(elem: HTMLDivElement): void {
    elem.classList.add('dropdown-closed');
    setTimeout(() => {
      elem.classList.remove('dropdown-closed');
    }, 150);
  }

  public logout(): void {
    this.tokenStorageService.signOut();
    this.router.navigate([`/`]);
  }
}

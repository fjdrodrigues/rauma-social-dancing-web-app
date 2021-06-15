import { Component, HostListener, OnInit } from '@angular/core';
import { TokenStorageService } from '../../components/shared/security/token-storage.service';
import { Router, NavigationStart, Scroll } from '@angular/router';

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

  @HostListener('window:scroll', ['$event']) onScroll(event : Scroll) {
    if(window.scrollY === 0) {
      document.getElementById("adk-navbar").style.boxShadow = "none";
    } else {
      document.getElementById("adk-navbar").style.boxShadow = "0px 2px 4px 2px #d799226e";
    }
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

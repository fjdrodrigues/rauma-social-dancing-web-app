import { Component, Injector, OnDestroy } from '@angular/core';
import { Subscription } from 'rxjs';

@Component({
  template: ''
})
export class BaseComponent implements OnDestroy {
  private subsArray: Subscription[] = [];

  constructor() {
  }

  public set sub(sub: Subscription) {
    if (sub instanceof Subscription) {
      this.subsArray.push(sub);
    }
  }

  public ngOnDestroy() {
    this.unsubscribeAll();
  }

  protected unsubscribeAll() {
    this.subsArray.forEach(sub => sub.unsubscribe());
    this.subsArray = [];
  }

  public onError(res: any) {
    console.log(res);
  }
}